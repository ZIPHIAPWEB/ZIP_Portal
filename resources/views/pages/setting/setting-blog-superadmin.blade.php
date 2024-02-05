@extends('layouts.app')

@section('title', 'Host Company Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button data-toggle="modal" @click="openCreateBlog()" class="btn btn-primary btn-sm btn-flat pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <th>ID</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Initial Content</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </thead>
                        <tbody v-if="blogs.length > 0">
                            <tr v-for="blog in blogs">
                                <td>@{{ blog.id }}</td>
                                <td class="text-center">@{{ blog.title }}</td>
                                <td class="text-center">@{{ blog.slug }}</td>
                                <td class="text-center">@{{ blog.initial_content }}</td>
                                <td class="text-center"><a target="_blank" :href="blog.image_path">@{{ blog.image_path }}</a></td>
                                <td class="text-center">@{{ blog.created_at }}</td>
                                <td class="text-center">
                                    {{-- <button @click="editBlog(blog)" data-toggle="modal" data-target="#edit-modal" class="btn btn-flat btn-success btn-xs">Edit</button> --}}
                                    <button @click="deleteBlog(blog.slug)" class="btn btn-flat btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td valign="top" colspan="8" class="text-center">
                                    No Records
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="create-modal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create Blog</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="host-name">Title</label>
                                <input v-model="form.title" type="text" class="form-control" placeholder="Enter Blog Title">
                            </div>
                            <div class="form-group">
                                <label for="host-state">Initial Content</label>
                                <textarea v-model="form.initial_content" style="resize: none;" type="text" class="form-control" placeholder="Enter Blog Initial Content" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="host-state">Content</label>
                                <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                            </div>
                            <div class="form-group">
                                <input type="file" ref="formImage" @change="handleFileUpload()">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="addBlog()" class="btn btn-primary btn-block btn-flat">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="edit-modal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Blog</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="host-name">Title</label>
                                <input id="blog-title" v-model="selectedBlog.title" type="text" class="form-control" placeholder="Enter Blog Title">
                            </div>
                            <div class="form-group">
                                <label for="host-state">Content</label>
                                <ckeditor :editor="editor" v-model="selectedBlog.content" :config="editorConfig"></ckeditor>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="updateBlog()" class="btn btn-success btn-block btn-flat">Update</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        class MyUploadAdapter {
            constructor( loader ) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }
            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }
            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }
            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', '/blogImage/upload', true );
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }
            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;
                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }
                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );
                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }
            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();
                data.append( 'upload', file );
                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.
                // Send the request.
                this.xhr.send( data );
            }
            // ...
        }
        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }
        const app = new Vue({
            el: '#app',
            data: {
                blogs: [],
                selectedBlog:[],
                form: {
                    title: '',
                    initial_content: '',
                    content: '',
                    file: ''
                },
                editor: ClassicEditor,
                editorConfig: {
                    extraPlugins: [SimpleUploadAdapterPlugin],
                    mediaEmbed: {
                        previewsInData: true
                    }
                }
            },
            mounted () {
                this.loadBlogs();
            },
            methods: {
                handleFileUpload() {
                    this.form.file = this.$refs.formImage.files[0];
                },
                loadBlogs() {
                    axios.get('/getAllBlogs')
                        .then((response) => {
                            this.blogs = response.data;
                        })
                },
                openCreateBlog () {
                    $( '#create-modal' ).modal( {
                        focus: false,
                        show: true
                    } );
                },
                addBlog() {
                    let formData = new FormData();
                    formData.append('title', this.form.title);
                    formData.append('initial_content', this.form.initial_content);
                    formData.append('content', this.form.content);
                    formData.append('image', this.form.file);

                    axios.post('/addBlog', formData)
                        .then((response) => {
                            this.blogs.unshift(response.data);
                            this.form.title = '';
                            this.form.content = '';
                            this.form.file = '';
                            $('#create-modal').modal('hide');
                        })
                },
                editBlog(blog) {
                    this.selectedBlog = blog;
                },
                updateBlog(blog_id) {
                    let title = document.getElementById('blog-title');
                    let content = document.getElementById('blog-content');

                },
                deleteBlog(slug) {
                    axios.delete(`/deleteBlog/${slug}`)
                        .then((response) => {
                            console.log(response.data);
                            this.loadBlogs();
                        })
                }
            }
        })
    </script>
@endsection