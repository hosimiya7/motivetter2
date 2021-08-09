<template>
    <div class="message-achieve">

        <h3>▼ 達成入力</h3>

        <div class="achieve" v-bind:class="{active: this.selectedAchieveCursor === 0}">
            <span>入力:</span>
            <input type="text" name="" id="achieve" autofocus>
            <span>(単位) 達成！！</span>
        </div>
        <div class="register" v-bind:class="{active: this.selectedAchieveCursor === 1}">
            <span>登録</span>
        </div>

    </div>
</template>

<script>
export default {
    created: function() {
        addEventListener('keyup', this.selectCommand)
    },
    data() {
        return {
            selectedAchieveCursor: 0,
        }
    },
    methods: {
        selectCommand(e) {
        //下
            if(e.keyCode === 40 && this.selectedAchieveCursor < 1){
                this.selectedAchieveCursor++
                console.log(this.selectedAchieveCursor)
            }
        // 上
            if(e.keyCode === 38 && this.selectedAchieveCursor > 0){
                this.selectedAchieveCursor--
                console.log(this.selectedAchieveCursor)
            }
            if(e.keyCode === 32){
                if(this.selectedGoalCursor === 0){
                    document.getElementById("achieve").focus();
                }
                if(this.selectedGoalCursor === 1){

                }
            }
        }
    }
}
</script>