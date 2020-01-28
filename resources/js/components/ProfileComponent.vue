<template>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 mt-5">
                <div class="row">
                <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="#" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Inam ul haq</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
           <!-- /.card -->
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
            
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
         

                  <div class="tab-pane active" id="settings">
                    <form @submit.prevent="addprofile">
                      <div class="form-group row">
                      <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input v-model="form.username" type="text" name="username" placeholder="Username"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                        <has-error :form="form" field="username"></has-error>
                       </div>
                      </div>             
                      <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input v-model="form.email" type="text" name="email" placeholder="Email"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                       </div>
                      </div>
                                                        
                       
                                                    
                       <div class="form-group row">
                      
                          <div class="col-md-3" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
                           </div>
                          <div class="col-md-9">
                              <input type="file" v-on:change="onImageChange" class="form-control">
                          </div>
                          <!-- <div class="col-md-3">
                             <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
                          </div> -->
                                       
                      </div>
                     
                       <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                      <div class="col-sm-10">
                        <textarea v-model="form.experience" type="text" name="experience" placeholder="Experience"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('experience') }"></textarea>
                        <has-error :form="form" field="experience"></has-error>
                       </div>
                      </div>
                       <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                      <div class="col-sm-10">
                        <textarea v-model="form.skills" type="text" name="skills" placeholder="Skills"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('skills') }"></textarea>
                        <has-error :form="form" field="skills"></has-error>
                       </div>
                      </div>
                  
                      <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';

    export default {
      props: {
    value: File
  },
      data(){
        return{
          image:'',
          form: new Form({

              username:'',
              email:'',
              experience:'',
              skills:'',
              

          })


          
        }
      },
        mounted() {
            
        },
        methods:{
               onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/image/store',{image: this.image}).then(response => {
                   if (response.data.success) {
                     alert(response.data.success);
                   }
                });
            }
        }
    }
</script>



