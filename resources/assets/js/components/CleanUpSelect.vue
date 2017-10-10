<template lang="html">
    <div class="row" style="position: relative;">
        <transition name="fade">
            <div class="alert info" :class="messageClass" role="alert" v-show="msg.show">
                <i class="fa fa-info-circle"></i> {{msg.message}}
            </div>
        </transition>
        <div class=" col-lg-2 col-md-6" v-for="(day, index) in days">
            <div class="card m-1">
                <div class="card-body">
                    <p class="text-center">{{day.date | date}}</p>
                    <form v-if="day.isDefault" class="" @submit.prevent="addCleanup(index)">
                        <button type="submit" class="btn btn-success form-control">
                            <i class="fa fa-plus"> Eintragen</i>
                        </button>
                    </form>

                    <div v-else>
                        <div class="btn btn-warning form-control">
                            <i class="fa fa-check"></i> {{day.user.name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let moment = require('moment');
class Message {
    constructor(){
        this.show = false;
        this.type = "success";
        this.message = "";
    }

    showMessage(msg, type = "success"){
        this.message = msg;
        this.type = type;
        this.show = true;
        setTimeout(() => {
            this.show = false;
        }, 2000);
    }
}

class Day {
    constructor(){
        this.date = "";
        this.isDefault = true;
        this.user = {};
    }

    setDate(date){
        this.date = date;
    }

    setUser(user){
        this.isDefault = false;
        this.user = user;
    }
}
export default {
    props: ['cleanUpProp'],
    data: function(){
        return{
            days: [],
            cleanUps: this.cleanUpProp,
            msg: new Message(),
        }
    },
    methods: {
        addCleanup: function(index){
            let vue = this;
            axios.post('/cleanUps/add' ,{
                date: moment(vue.days[index].date).format('YYYY-MM-DD'),
                user_id: auth.id
            }).then(function(response){
                vue.days[index].setUser(response.data.data.user);
                vue.msg.showMessage(response.data.message);
            }).catch(function (errors){
                vue.msg.showMessage(errors.response.data.message, "danger");
            });
        },
    },
    created: function(){
        let days = [];
        let taken = [];
        let dates = this.cleanUps.map(function(item){
            return moment(item.date, 'YYYY-MM-DD').format();
        });
        for(let i=0; i<6; i++){
            let day = moment().add(i, "days")
            day.hours(0);
            day.minutes(0);
            day.seconds(0);
            day.milliseconds(0);
            day = moment(day).format()
            let e = new Day();
            e.setDate(day);
            if(dates.indexOf(day) >= 0){
                let item = this.cleanUps[dates.indexOf(day)];
                e.setUser(item.user);
                days.push(e);
            }else{
                days.push(e);
            }
        }
        this.days = days;
    },
    filters: {
        date: function(value){
            return moment(value).format('D.MM.YYYY');
        }
    },
    computed: {
        messageClass: function(){
            return 'alert-' + this.msg.type;
        },
    },
}
</script>

<style lang="css" scoped>
    .info{
        position: absolute;
        top: 5px;
        right: 0;
        z-index: 50;
    }

    .fade-enter-active, .fade-leave-active{
        transition: opacity 0.2s ease-out;
    }
    .fade-enter, .fade-leave-to{
        opacity: 0;
    }
</style>
