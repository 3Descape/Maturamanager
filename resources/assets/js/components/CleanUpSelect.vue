<template lang="html">
    <div class="row">
        <div class="col-md-2" v-for="day in days">
            <div class="card m-1">
                <div class="card-body">
                    <p class="text-center">{{day | dateFormat}}</p>
                    <form v-if="!hasDate(day)" class="" @submit.prevent="addCleanup">
                        <button type="button" class="btn btn-success form-control">
                            <i class="fa fa-plus"> Eintragen</i>
                        </button>
                    </form>

                    <div v-else>
                        <div class="btn btn-warning form-control">
                            <i class="fa fa-check"></i> {{getUser(day)}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['cleanUpProp'],
    data: function(){
        return{
            numOfDays: 7,
            days: [],
            cleanUps: this.cleanUpProp
        }
    },
    methods: {
        generateDays: function (){
            let curr = new Date();
            for(let i = 1; i <= this.numOfDays; i++){
                let d = curr.addDays(i);
                this.days.push(d);
            }
        },
        hasDate: function(date){
            return this.getIndexOfDate(date) >= 0;
        },
        getIndexOfDate: function(date){
            let temp = this.cleanUps.map(function(item){
                return item.date == `${date.getFullYear()}-${('0'+(date.getMonth()+1)).slice(-2)}-${('0'+(date.getDate())).slice(-2)}`
            }, this);
            return temp.indexOf(true);
        },
        addCleanup: function(){
            console.log('test')
        },
        getUser: function(date){
            return this.cleanUps[this.getIndexOfDate(date)].user.name;
        }
    },
    created: function(){
        Date.prototype.addDays = function(days) {
            var dat = new Date(this.valueOf());
            dat.setDate(dat.getDate() + days);
            return dat;
        }

        this.generateDays();
    },
    filters: {
        dateFormat: (value) => {
            var weekday = new Array(7);
            weekday[0] =  "So.";
            weekday[1] = "Mo.";
            weekday[2] = "Di.";
            weekday[3] = "Mit.";
            weekday[4] = "Don.";
            weekday[5] = "Fr.";
            weekday[6] = "Sa.";
            return weekday[value.getDay()] + " " + value.getDate() + '.' + (value.getMonth()+1) + '.' + value.getFullYear();
        },
    }
}
</script>

<style lang="css" scoped>
    .cell{
        height: 15vh;
        padding: 10px;
    }
</style>
