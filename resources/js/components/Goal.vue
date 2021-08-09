<template>
    <div class="message-goal">

        <h3>▼ 目標入力・変更</h3>

            <div class="small-goal">
                <div class="small_goal_content" v-bind:class="{active: this.selectedGoalCursor === 0}">
                    <span>目標:</span>
                    <input type="text" name="" id="goal" placeholder="プログラミング">
                </div>
                <div class="small-goal-number" v-bind:class="{active: this.selectedGoalCursor === 1}">
                    <span>数値:</span>
                    <input type="text" name="" id="number" placeholder="3">
                </div>
                <div class="small-goal-unit" v-bind:class="{active: this.selectedGoalCursor === 2}">
                    <span>単位:</span>
                    <input type="text" name="" id="unit" placeholder="時間">
                </div>
                <div class="register" v-bind:class="{active: this.selectedGoalCursor === 3}">
                    <h4>登録</h4>
                </div>
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
            selectedGoalCursor: 0,
            isInputMode: false,
        }
    },
    methods: {
        selectCommand(e) {
        //下
            if(e.keyCode === 40 && this.selectedGoalCursor < 3 && this.$store.state.isInputMode === false){
                this.selectedGoalCursor++
            }
        // 上
            if(e.keyCode === 38 && this.selectedGoalCursor > 0 && this.$store.state.isInputMode === false){
                this.selectedGoalCursor--
            }
            // スペース　決定
            if(e.keyCode === 32){
                if(this.selectedGoalCursor === 0){
                    document.getElementById("goal").focus();
                    // 入力モードに切り替える
                    this.$store.state.isInputMode = true
                }
                if(this.selectedGoalCursor === 1){
                    document.getElementById("number").focus();
                    this.$store.state.isInputMode = true
                }
                if(this.selectedGoalCursor === 2){
                    document.getElementById("unit").focus();
                    this.$store.state.isInputMode = true
                }
                if(this.selectedGoalCursor === 3){
                    // 登録
                }
            }
            if(e.keyCode === 27 && this.$store.state.isInputMode === true){
                this.$store.state.isInputMode = false
                document.activeElement.blur()
            }
        }
    }
}
</script>