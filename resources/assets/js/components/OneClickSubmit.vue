<script>
export default {
    data: function(){
        return {
            isDisabled: false
        }
    },
    methods:{
        submitted(){
            this.isDisabled = true;
            let vue = this;
            setTimeout(function(){
                vue.isDisabled = false;
            }, 1500);
        }
    }
}
</script>

