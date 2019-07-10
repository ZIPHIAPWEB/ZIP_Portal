@extends('layouts.student-app')

@section('title', 'Chatbox features')

@section('page-title', 'Chatbox')

@section('content')
    <div id="chatbox" class="m-t-10" v-cloak>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Students</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input v-model="search_text" type="text" class="form-control input-sm" placeholder="Search List">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls clearfix">
                        <!--
                        <div class="pull-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped" style="overflow: scroll;">
                            <tbody v-if="!coor_load">
                                <tr  v-for="coor in sortedContacts">
                                    <td class="mailbox-star" style="width: 5%;"><a href="#"><i class="fa fa-circle text-danger"></i></a></td>
                                    <td class="mailbox-name text-center">
                                        <a @click="SELECT_MESSAGE(coor.user_id)" href="javascript:void(0);">
                                            <strong>@{{ coor.firstName }}  @{{ coor.lastName }}</strong>
                                        </a>
                                    </td>
                                    <td v-if="coor.unread !== 0" class="mailbox-attachments"><span v-if="(selectedCoordinator !== coor.user_id) ? true : false" class="badge">@{{ coor.unread }}</span></td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td class="text-center" colspan="2"><span class="fa fa-circle-o-notch fa-spin"></span></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary direct-chat direct-chat-primary" >
                <div class="box-header with-border">
                    <h3 class="box-title">Direct Chat</h3>
                </div>
                <div class="box-body">
                    <div v-if="message_load" class="overlay-wrapper">
                        <div class="overlay">
                            <span class="fa fa-circle-o-notch fa-spin"></span>
                        </div>
                    </div>
                    <div id="chat" class="direct-chat-messages"style="max-height: 650px; height: 700px;">
                        <div v-for="message in messages">
                            <div v-if="message.sender_id == user.id" class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">@{{ message.firstName }} @{{ message.lastName }}</span>
                                    <span class="direct-chat-timestamp pull-right">@{{ message.created_at }}</span>
                                </div>
                                <img class="direct-chat-img" src="https://via.placeholder.com/150/000000" alt="Message User Image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    @{{ message.message }}
                                </div>
                            </div>
                            <div v-else class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Me</span>
                                    <span class="direct-chat-timestamp pull-left">@{{ message.created_at }}</span>
                                </div>
                                <img class="direct-chat-img" src="https://via.placeholder.com/150/0000ff" alt="Message User Image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    @{{ message.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <form @submit.prevent="SEND_MESSAGE()">
                            <div class="input-group">
                                <input v-model="inputted_text" type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                                    <button @click="SEND_MESSAGE()" type="button" class="btn btn-primary btn-flat">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let program_id = {{ \App\Student::where('user_id', Auth::user()->id)->first()->program_id }};

        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                auth: program_id,
                url: '/portal/c/program/',
                programs: []
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                        })
                }
            }
        });

        const chatbox = new Vue({
            el: '#chatbox',
            data: {
                auth: program_id,
                user: '{!! Auth::user()->toJson() !!}',
                coordinators: [],
                messages: [],
                selectedCoordinator: '',
                inputted_text: '',
                search_text: '',
                coor_load: true,
                message_load: false
            },
            mounted: function () {
                this.GET_COORDINATORS();
                this.LISTEN();
            },
            watch: {
                selectedCoordinator: function (value) {
                    this.GET_MESSAGES(value);
                },
                search_text: function (value) {
                    this.search_text = value;
                    this.GET_COORDINATORS();
                }
            },
            computed: {
                sortedContacts: function () {
                    return _.sortBy(this.coordinators.data, [(contact) => {
                        if (contact === this.selectedStudent) {
                            return Infinity;
                        }

                        return contact.unread;
                    }]).reverse();
                }
            },
            methods: {
                LISTEN: function () {
                    Echo.private(`receiver.${this.user.id}`)
                        .listen('MessageSentEvent', (e) => {
                            this.handleIncoming(e);
                            console.log(e);
                        })
                },
                GET_COORDINATORS: function () {
                    axios.get('/chat/getContacts', {
                            params: {
                                program_id : this.auth,
                                search: this.search_text
                            }
                        })
                        .then((response) => {
                            this.coor_load = false;
                            this.coordinators = response.data;
                        })
                },
                scrollToEnd: function() {
                    setTimeout(() => {
                        var container = this.$el.querySelector("#chat");
                        container.scrollTop = container.scrollHeight;
                    }, 500);
                },
                SELECT_MESSAGE: function (coordinatorId) {
                    this.selectedCoordinator = coordinatorId;
                    this.scrollToEnd();
                },
                GET_MESSAGES: function () {
                    axios.get('/chat/getMessages', {
                        params: {
                            userId : this.selectedCoordinator
                        }
                    })
                        .then((response) => {
                            this.messages = response.data
                        })
                },
                SEND_MESSAGE: function () {
                    let formData = new FormData();
                    formData.append('selectedRecipient', this.selectedCoordinator);
                    formData.append('inputted_text', this.inputted_text);

                    axios.post('/chat/sendMessage', formData)
                        .then((response) => {
                            this.messages.push(response.data);
                            this.scrollToEnd();
                            this.inputted_text = '';
                        })
                },
                handleIncoming: function (message) {
                    if (this.selectedCoordinator === message.message.receiver_id) {
                        this.messages.push(message.message);
                        this.scrollToEnd();
                    }
                    this.updateUnreadCount(message.user.id, false);
                },
                updateUnreadCount: function(contact, reset) {
                    this.coordinators.data = this.coordinators.data.map((single) => {
                        if (single.user_id !== contact) {
                            return single;
                        }

                        if (reset) {
                            single.unread = 0;
                        } else {
                            single.unread += 1;
                        }

                        return single;
                    })
                }
            }
        });
    </script>
@endsection