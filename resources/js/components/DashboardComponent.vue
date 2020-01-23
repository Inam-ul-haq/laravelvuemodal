<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5" >
             
            <label>Date</label> <datetime v-model="date"></datetime><br>
            <label>From time</label>
             <datetime type="time" title="Hour/Minutes" v-model="timestart" ></datetime><br>
             <label>To time</label>
             <datetime type="time" title="Hour/Minutes" v-model="timeend" ></datetime><br>
             <button @click='alertVal'>Alert current date value</button><br>
             <label></label>
             <h1>Difference: {{ Difference }}</h1>
             <h1>slot: {{Duration}}</h1>
             
  <select v-model="customerName">
   <option value="5">5</option>
   <option value="10">10</option>
   <option value="15">15</option>
   <option value="20">20</option>
    </select>
            </div>
           
            <div class="col-md-6 mt-5">
<ul>
<p v-for="i in num_items">
{{message}}
</p>
<li v-for="(student,index) in students"> {{index}}-{{ student}}</li>

</ul>

            </div>
          
  
        
           
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import { Datetime } from 'vue-datetime';
    export default {
 
          components: {
            datetime: Datetime
          },
          data(){
            return{
                students:["Sanjay","Naveed","Inam"],
                num_items:5,
                message:'hello',
                customerName: "",
                  date:'',
                  timestart:'',
                  timeend:''
                  }

              },
              methods: {
                alertVal() {
                  alert(this.date)
                },

             },computed: {
                Difference: function () {
                  
                  return moment(this.timeend).diff(moment(this.start),'minutes')
                },
                Duration: function(){
                return this.Difference/this.customerName
                }

                }
    }
</script>
