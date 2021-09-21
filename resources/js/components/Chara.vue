<template>
    <div class="message-chara">

        <h3>▼ キャラクター管理</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span v-bind:class="{active: this.selectedCharaCursor === 0}">ステータス</span>
                <span v-bind:class="{active: this.selectedCharaCursor === 1}">えさやり</span>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.selectedCharaCursor === 2}">キャラ図鑑</span>
                <span v-bind:class="{active: this.selectedCharaCursor === 3}">おわかれ</span>
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
            selectedCharaCursor: 0,
        }
    },
    methods: {
        selectCommand(e) {
        //下
            if(e.keyCode === 40 && this.selectedCharaCursor < 3){
                this.selectedCharaCursor++
            }
        // 上
            if(e.keyCode === 38 && this.selectedCharaCursor > 0){
                this.selectedCharaCursor--
            }
        // スペース　決定
            if(e.keyCode === 32){
                if(this.selectedCharaCursor === 0){
                    //ステータスを表示する
                    this.$store.commit('setSelectedCommand', 5)
                }
                if(this.selectedCharaCursor === 1){
                    //えさやり
                    //餌画面を表示する
                    //this.$store.commit('setSelectedCommand', 6)

                }
                if(this.selectedCharaCursor === 2){
                    //キャラ図鑑を表示する
                    //this.$store.commit('setSelectedCommand', 7)

                }
                if(this.selectedCharaCursor === 3){
                    //おわかれ画面を表示する
                    //this.$store.commit('setSelectedCommand', 8)


                }
            }
            if(e.keyCode === 27 && this.$store.state.isInputMode === true){
                this.$store.state.isInputMode = false
                // focusを外す。
                document.activeElement.blur()
            }
        }
    }
}
</script>