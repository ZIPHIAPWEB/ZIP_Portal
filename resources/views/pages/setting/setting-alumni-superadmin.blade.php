@extends('layouts.app')

@section('title', 'Host Company Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button data-toggle="modal" data-target="#create-modal" class="btn btn-primary btn-sm btn-flat pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <th>ID</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Initial Content</th>
                            <th class="text-center">Content</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </thead>
                        <tbody v-if="blogs.length > 0">
                            <tr v-for="blog in blogs">
                                <td>@{{ blog.id }}</td>
                                <td class="text-center">@{{ blog.title }}</td>
                                <td class="text-center">@{{ blog.slug }}</td>
                                <td class="text-center">@{{ blog.initial_content}}</td>
                                <td class="text-center">@{{ blog.content }}</td>
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

        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog">
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
                                <label for="host-state">Content</label>
                                <textarea v-model="form.initial_content" style="resize: none;" type="text" class="form-control" placeholder="Enter Blog Initial Content" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="host-state">Content</label>
                                <textarea v-model="form.content" style="resize: none;" type="text" class="form-control" placeholder="Enter Blog Content" rows="15"></textarea>
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

        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog">
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
                                <textarea id="blog-content" v-model="selectedBlog.content" style="resize: none;" type="text" class="form-control" placeholder="Enter Blog Content" rows="15"></textarea>
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
                    axios.get('/getAllAlumni')
                        .then((response) => {
                            this.blogs = response.data;
                        })
                },
                addBlog() {
                    let formData = new FormData();
                    formData.append('title', this.form.title);
                    formData.append('content', this.form.content);
                    formData.append('image', this.form.file);
                    formData.append('initial_content', this.form.initial_content);
                    axios.post('/addAlumniBlog', formData)
                        .then((response) => {
                            this.blogs.unshift(response.data);
                            this.form.title = '';
                            this.form.content = '';
                            this.form.file = '';
                            this.form.initial_content = '';
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
                    axios.delete(`/deleteAlumniBlog/${slug}`)
                        .then((response) => {
                            console.log(response.data);
                            this.loadBlogs();
                        })
                }
            }
        })
    </script>
@endsection