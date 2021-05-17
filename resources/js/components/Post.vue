<template>
    <div>
        <h1>Listing</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add New List
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="edit" class="modal-title" id="exampleModalLabel">Update</h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" :class="['form-control',errors.title?'is-invalid':'']"  v-model="post.title" id="title"   placeholder="Enter title"> 
                                <span class="bg-danger text-white p-1 rounded" v-if="errors.title">{{errors.title[0]}}</span>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number"  v-model="post.price" :class="['form-control',errors.price?'is-invalid':'']" id="price"   placeholder="Enter price"> 
                                </div>
                                <span class="bg-danger text-white p-1 rounded" v-if="errors.price">{{errors.price[0]}}</span>

                            </div>
                            <div class="form-group">
                                <label for="title">Area</label>
                                <input type="text" v-model="post.area" class="form-control" id="area"   placeholder="Enter area"> 
                            </div>
                            <div class="form-group">
                                <label for="title">Address</label>
                                <textarea class="form-control" id="address"  v-model="post.address"  placeholder="Enter full address"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name"   v-model="post.name" placeholder="Enter name"> 
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" :class="['form-control',errors.email?'is-invalid':'']" id="email"  v-model="post.email"  placeholder="Enter email"> 
                                <span class="bg-danger text-white p-1 rounded" v-if="errors.email">{{errors.email[0]}}</span>

                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">+46</div>
                                    </div>
                                    <input type="text" class="form-control"  v-model="post.phoneNumber" id="phoneNumber"   placeholder="Enter phone"> 
                                </div>
                            </div> 
                            <button v-if="edit" type="submit" @click="updatePost" class="btn btn-primary">Update</button>
                            <button v-else  type="submit" @click="createPost" class="btn btn-primary">Add</button>
                            
    
                    </div> 
                </div>
            </div>
        </div>

        <div>

            <table class="table">
                <thead>
                    <tr> 
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Area</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">phoneNumber</th> 
                    <th scope="col"></th> 
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts" :key="post.id"> 
                        <td>{{post.title}}</td>
                        <td>{{post.price}}</td> 
                        <td>{{post.area}}</td> 
                        <td>{{post.address}}</td> 
                        <td>{{post.email}}</td> 
                        <td>{{post.name}}</td> 
                        <td>{{post.phoneNumber}}</td> 
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="editPost(post)">
                                Edit
                            </button>
                        </td>  
                    </tr> 
                </tbody>
                </table>
        </div>
    </div>
    
</template> 
<script>
export default{
    data(){
        return{
            post:{
                    id:'' , 
                    title:'', 
                    price:'',
                    area:'',
                    address:'',
                    name:'',
                    email:'',
                    phoneNumber:'',
                },
                posts:{},
                edit:false,
                errors:[]  
            }
        },
        methods:
        {
            createPost()
            {
                this.edit=false;
                axios
                .post('api/createpost',this.post)
                .then(
                    response=>{
                        if(response.data.status =='error')
                        {
                            this.errors = response.data.errors;

                        }else if(response.data.status=='success')
                        {
                            this.posts.unshift(response.data.data);
                            Toast.fire({
                                icon:'success',
                                title:'Inserted Successfully'
                            });
                            $("#exampleModal").modal('hide');

                        }
                    }
                )
            },
            getPost()
            {
                axios.get('api/getposts')
                .then(
                    response=>
                    {
                       this.posts = response.data.data;

                    }
                )
            },
            editPost(post)
            {
                this.post=post;
                this.edit = true;
                 
            },
            updatePost()
            { 
                axios
                .post('api/updatepost/'+this.post.id,this.post)
                .then(
                    response=>{
                        if(response.data.status =='error')
                        {
                            this.errors = response.data.errors;

                        }else if(response.data.status=='success')
                        {
                            Toast.fire({
                                icon:'success',
                                title:'Updated Successfully'
                            });
                            $("#exampleModal").modal('hide');

                        }
                    }
                )
            },
        },
        created()
        {
            this.getPost()
        }
    }</script>