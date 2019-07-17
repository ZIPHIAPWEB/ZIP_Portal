
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ZIP Travel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    @media screen and (min-width : 1550px) {
        .container {
            width: 1550px;
        }
    }
</style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ route('welcome') }}" class="navbar-brand"><b>ZIP Travel</b> Philippines</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="{{ route('logout') }}" >
                                <i class="glyphicon glyphicon-log-out"></i>
                            </a>
                        </li>
                        <!-- /.messages-menu -->

                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                    <div id="chatbox" class="box box-primary direct-chat direct-chat-primary collapsed-box" style="width: 400px; position: fixed; bottom: 0; right: 15px; z-index: 9; border: 1px black solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">@{{ selectedCoordinator ? selectedCoordinator.firstName + ' ' + selectedCoordinator.lastName : 'Direct Chat' }}</h3>
                    
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button id="contact-toggle" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div id="chat-container" class="direct-chat-messages">
                                    <div v-for="message in messages">
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg" v-if="message.sender_id == user.id">
                                            <div class="direct-chat-info clearfix">
                                            <!--<span class="direct-chat-name pull-left">@{{ message.firstName }} @{{ message.lastName }}</span>-->
                                            <span class="direct-chat-timestamp pull-right">@{{ message.created_at }}</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="https://via.placeholder.com/150/000000" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text text-sm">
                                                @{{ message.message }}
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                        
                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right" v-else>
                                            <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">Me </span>
                                            <span class="direct-chat-timestamp pull-left">@{{ message.created_at }}</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="https://via.placeholder.com/150/0000ff" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text text-sm">
                                                @{{ message.message }}
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    </div>
                                </div>
                                <!--/.direct-chat-messages-->
                    
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li v-for="coor in coordinators.data" style="border: 1px white solid">
                                        <a href="#" @click="SELECT_MESSAGE(coor)">
                                            <img class="contacts-list-img" src="https://placeimg.com/128/128/any" alt="User Image">
                    
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    @{{ coor.firstName }} @{{ coor.lastName }}
                                                </span>
                                            <span class="contacts-list-msg"></span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                </ul>
                                <!-- /.contatcts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <form @submit.prevent="SEND_MESSAGE()">
                                <div class="input-group">
                                    <input id="my-input" v-model="inputted_text" type="text" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-btn">
                                        <button @click="SEND_MESSAGE()" type="button" class="btn btn-primary btn-flat">Send</button>
                                        </span>
                                </div>
                                </form>
                            </div>
                            <!-- /.box-footer-->
                        </div>
                @yield('content')
            </section>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            All rights reserved {{ date('Y') }}
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    let program_id = {{ \App\Student::where('user_id', Auth::user()->id)->first()->program_id }};
        const chatbox = new Vue({
            el: '#chatbox',
            data: {
                auth: program_id,
                user: {!! Auth::user()->toJson() !!},
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
                var contactsToggle = this.$el.querySelector('#contact-toggle');
                contactsToggle.click();
            },
            watch: {
                selectedCoordinator: function (value) {
                    this.GET_MESSAGES(value.user_id);
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
                        var container = this.$el.querySelector("#chat-container");
                        container.scrollTop = container.scrollHeight;
                    }, 500);
                },
                SELECT_MESSAGE: function (coordinator) {
                    this.selectedCoordinator = coordinator;
                    var contactsToggle = this.$el.querySelector('#contact-toggle');
                    contactsToggle.click();
                    this.scrollToEnd();
                },
                GET_MESSAGES: function (userId) {
                    axios.get('/chat/getMessages', {
                        params: {
                            userId : userId
                        }
                    })
                    .then((response) => {
                        this.messages = response.data
                    })
                },
                SEND_MESSAGE: function () {
                    let formData = new FormData();
                    formData.append('selectedRecipient', this.selectedCoordinator.user_id);
                    formData.append('inputted_text', this.inputted_text);

                    axios.post('/chat/sendMessage', formData)
                        .then((response) => {
                            this.messages.push(response.data);
                            this.scrollToEnd();
                            this.inputted_text = '';
                        })
                },
                handleIncoming: function (message) {
                    if (this.selectedCoordinator.user_id == message.message.receiver_id) {
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
@yield('script')
</body>
</html>
