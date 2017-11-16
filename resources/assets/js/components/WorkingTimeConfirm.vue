<template lang="html">
    <div class="col-md-12 mt-4">
        <ul class="list-group">
            <li class="list-group-item p-1">
                <div class="row">
                    <div class="col-lg-2 col-sm-4 col-12 order-1"><p class="m-0 ml-3">Person</p></div>
                    <div class="col-lg-2 col-sm-4 col-12 order-2"><p class="m-0">Zeit <i class="text-muted">in Minuten</i></p></div>
                    <div class="col-lg-5 col-sm-12 col-12 order-4 order-lg-3"><p class="ml-3 ml-lg-0">Beschreibung</p></div>
                    <div class="col-lg-2 col-sm-4 col-12 order-3 order-lg-4"><p class="m-0">Datum</p></div>
                    <div class="col-lg-1 col-sm-4 col-12 d-lg-flex d-none order-5"><p class="ml-auto m-0 mr-3">Bestätigen</p></div>
                </div>
            </li>
            <li class="list-group-item p-1" v-for="work in workingTimes">
                <div class="row">
                    <div class="col-lg-2 col-sm-4 col-12 order-1">
                        <span class="m-0 ml-sm-3">{{work.user.name}}</span>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12 order-2">
                        {{work.working_time}} <span class="text-muted">min.</span>
                    </div>
                    <div class="col-lg-5 col-sm-10 col-12 order-4 order-lg-3 ">
                        <span class="m-0 ml-sm-3">{{work.description != null ? work.description : '-'}}</span>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-12 order-3 order-lg-4">
                        {{work.date}}
                    </div>
                    <div class="col-lg-1 d-lg-flex col-sm-2 col-12 order-5">
                        <form class="align-self-start ml-auto" action="index.html" method="post" @submit.prevent="update(work.id)">
                            <button v-if="!work.working" class="fa btn" v-bind:class="[work.confirmed ? 'fa-check btn-success': 'fa-times btn-danger']" type="submit"></button>
                            <i v-if="work.working" class="btn btn-primary"><i class="fa-spinner fa fa-pulse"></i></i>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
let moment = require('moment');
export default {
    props: ['workingTimesProp'],
    data: function(){
        return{
            workingTimes: this.workingTimesProp,
        }
    },
    methods: {
        update(id){
            var vue = this;
            var temp_index = null;
            this.workingTimes.map(function(element, index){
                if(element.id === id){
                    element.confirmed = !element.confirmed
                    element.working = true
                    temp_index = index
                }
            });

            axios.post('/working_time/' + id +'/toggleConfirm', {
                _method: 'PUT'
            }).then(function(response){
                var obj = vue.workingTimes[temp_index];
                var cloned = Object.assign({}, obj);
                cloned.working = false;
                vue.workingTimes.splice(temp_index, 1, cloned);
            }).catch(function(error){
            });
        }
    },
    created: function(){
        moment.locale('de');
        this.workingTimes.map(function(element){
            element.working = false
            element.date = moment(element.date).format("dd DD.MM")
        });
    }
}
</script>
