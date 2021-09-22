<template>
    <div class="message-chara">

        <h3>▼ えさやり</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span v-bind:class="{active: this.selectedCharaFoodCursor === 0}">いちご</span>
                <span v-bind:class="{active: this.selectedCharaFoodCursor === 1}">もち</span>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.selectedCharaFoodCursor === 2}">メロン</span>
                <span v-bind:class="{active: this.selectedCharaFoodCursor === 3}">にく</span>
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
            selectedCharaFoodCursor: 0,
        }
    },
    methods: {
        selectCommand(e) {
        //下
            if(e.keyCode === 40 && this.selectedCharaFoodCursor < 3){
                this.selectedCharaFoodCursor++
            }
        // 上
            if(e.keyCode === 38 && this.selectedCharaFoodCursor > 0){
                this.selectedCharaFoodCursor--
            }
        // スペース　決定
            if(e.keyCode === 32){
                if(this.selectedCharaFoodCursor === 0){

                }
                if(this.selectedCharaFoodCursor === 1){

                }
                if(this.selectedCharaFoodCursor === 2){

                }
                if(this.selectedCharaFoodCursor === 3){

                }
            }
            if(e.keyCode === 27 && this.$store.state.isInputMode === true){
                // this.$store.state.isInputMode = false
                // // focusを外す。
                // document.activeElement.blur()
            }
        }
    }
}
</script>