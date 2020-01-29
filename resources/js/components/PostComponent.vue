<template>
    <div class="container">
        <div class="row mt-5">
         <div class="col-md-12">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">VueJs Post Crud</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <button class="form-control float-right" v-on:click="showmodal"> Add Post</button>

                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="post in posts" :key="post.id">
                      <td>{{post.id}}</td>
                      <td>{{post.title.substring(0,15)+"...." }}</td>
                      <td>{{post.description.substring(0,25)+"...." | uppertext}}</td>
                      <td><span class="tag tag-success">{{post.created_at | date}}</span></td>
                      <td><a href="#" v-on:click ="edit(post)" ><i class="fas fa-edit"></i></a>  <a href="#" v-on:click ="deletePost(post.id)"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    
                    
                  </tbody>
                </table>
              </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="exampleModalLabel">Add Post</h5>
                        <h5 v-show="editmode" class="modal-title" id="exampleModalLabel">Update Post</h5>
                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                       <form @submit.prevent="editmode ? updatepost() : createpost()">
                      <div class="modal-body">
                         <div class="form-group">
                          <label>Title</label>
                          <input v-model="form.title" type="text" name="title"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" required>
                          <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea v-model="form.description" type="text" name="description"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required></textarea>
                          <has-error :form="form" field="description"></has-error>
                        </div>          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editmode" type="submit"  class="btn btn-primary">
                        Add
                        </button>
                        <button v-show="editmode" type="submit"  class="btn btn-success">
                        Update
                        </button>
                       
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              <!-- /.card-body -->
            </div>
         </div>   
        </div>
    </div>

</template>

<script>
 import axios from 'axios';

import { Form, HasError, AlertError } from 'vform';
    export default {
        
    data () {
    return {
    editmode: false,
    posts: [],
      // Create a new form instance
      form: new Form({
        id: '',
        title: '',
        description: ''
       
      })
    }
  },methods: {
  updatepost(){
                        this.$Progress.start()
                        this.form.put('api/posts/'+this.form.id).then(()=>{
                        $('#exampleModal').modal('hide');
                        Toast.fire({
                         icon: 'success',
                        title: 'Data updated  in database successfully'}) 
                        this.$Progress.finish()
                        Fire.$emit('aftercreated');

    })
    .catch(()=>{


    });
  
  },
  showmodal(){
            this.editmode =false;
         this.form.reset();
         $('#exampleModal').modal('show');
  },
    edit(post){
        this.editmode =true;
         this.form.reset();
         $('#exampleModal').modal('show');
         this.form.fill(post);
  },
    createpost (){
        this.$Progress.start()
      // Submit the form via a POST request
      this.form.post('/api/posts')
      .then(()=>{
          Fire.$emit('aftercreated');
         $('#exampleModal').modal('hide')
          Toast.fire({
          icon: 'success',
          title: 'Data saved  in database successfully'}) 
         this.$Progress.finish()
      })
      .catch(()=>{
         this.$Progress.fail()     
          })
     
    },
    loadUser(){
        axios.get('/api/posts').then(response => {
                    this.posts = response.data.data;
                });

    },
      deletePost(id){ 
        
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                   if (result.value) {
                  this.form.delete('api/posts/'+id).then(()=>{
                 Fire.$emit('aftercreated');
                            swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                                )
                                
                               })

                    .catch(()=>{
                   swal("Failed!","There was something Wrong.","warning");


                    });
  }
               
               
            })
            }
       
  },
        mounted() {
            this.loadUser();
            Fire.$on('aftercreated',()=>{
            this.loadUser();
            });
        }
    }
</script>
