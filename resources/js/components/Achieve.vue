<template>
    <div class="message-achieve">

        <h3>▼ 達成入力</h3>

        <div class="achieve" v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">
            <span>入力:</span>
            <input type="text" name="" id="achieve" v-model="achieve" placeholder="3">
            <span>(単位) 達成！！</span>
        </div>
        <div class="register" v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">
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
            isInputMode: false,
            achieve: null,
        }
    },
    methods: {
        selectCommand(e) {
        // //下
        //     if(e.keyCode === 40 && this.selectedAchieveCursor < 1 && this.$store.state.isInputMode === false){
        //         this.selectedAchieveCursor++
        //     }
        // // 上
        //     if(e.keyCode === 38 && this.selectedAchieveCursor > 0 && this.$store.state.isInputMode === false){
        //         this.selectedAchieveCursor--
        //     }
        // スペース
            if(e.keyCode === 32){

                if(this.selectedAchieveCursor === 0){
                    // document.getElementById("achieve").focus();
                    // this.$store.state.isInputMode = true
                }
                if(this.selectedAchieveCursor === 1){

                }
            }
        // ESC
             if(e.keyCode === 27 && this.$store.state.isInputMode === true){
                // this.$store.state.isInputMode = false
                // document.activeElement.blur()
            }
        }
    }
}
</script>