<template lang="html">
    <div class="col-md-12 mt-4">
        <ul class="list-group">
            <li class="list-group-item p-1 d-flex">
                <div class="col-lg-2 col-md-2"><p class="m-0">Person</p></div>
                <div class="col-lg-2 col-md-2"><p class="m-0">Zeit <i class="text-muted">in Minuten</i></p></div>
                <div class="col-lg-5 col-md-6"><p class="m-0">Beschreibung</p></div>
                <div class="col-lg-2 d-none d-lg-block"><p class="m-0">Ticket</p></div>
                <div class="col-lg-1 col-md-2 d-flex"><p class="ml-auto m-0">Bestätigen</p></div>

            </li>
                <li class="list-group-item p-1 d-flex" v-for="work in workingTimes">
                    <div class="col-lg-2 col-md-2">
                        {{work.user.name}}
                    </div>
                    <div class="col-lg-2 col-md-2">
                        {{work.working_time}}
                    </div>
                    <div class="col-lg-5 col-md-6">
                        {{work.description != null ? work.description : '-'}}
                    </div>
                    <div class="col-lg-2 col-md-3 d-none d-lg-block">
                        {{work.working_ticket != null ? work.working_ticket.name : '-'}}
                    </div>
                    <div class="col-lg-1 d-flex col-md-2">
                        <form class="align-self-start ml-auto" action="index.html" method="post" @submit.prevent="update(work.id)">
                            <button v-if="!work.working" class="fa btn" v-bind:class="[work.confirmed ? 'fa-check btn-success': 'fa-times btn-danger']" type="submit"></button>
                            <i v-if="work.working" class="btn btn-primary"><i class="fa-spinner fa fa-pulse"></i></i>
                        </form>
                    </div>
                </li>
        </ul>
    </div>
</template>

<script>
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
        this.workingTimes.map(function(element){
            element.working = false
        });
    }
}
</script>
