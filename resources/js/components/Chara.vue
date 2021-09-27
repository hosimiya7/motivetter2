<template>
    <div class="message-chara">

        <h3>▼ キャラクター管理</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">ステータス</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">えさやり</span>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">キャラ図鑑</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">おわかれ</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    created: function() {
        },
    mounted: function() {
        // addEventListener('keyup', this.selectCommand2)
    },
    data() {
        return {
            // 初回は普通なのに
            selectedCharaCursor: 0
        }
    },
    methods: {
        selectCommand2(e) {
            // console.log("chara-keyup")
        //下
            // if(e.keyCode === 40 && this.selectedCharaCursor < 3 && this.$store.state.screenId === 3){
            //     this.selectedCharaCursor++
            // }
        // 上
            // if(e.keyCode === 38 && this.selectedCharaCursor > 0 && this.$store.state.screenId === 3){
            //     this.selectedCharaCursor--
            // }
        // スペース　決定
            // if(e.keyCode === 32 && this.$store.state.screenId === 3){
            //     console.log(this.$store.state.screenId)
            //     console.log(this.selectedCharaCursor)
            //     if(this.selectedCharaCursor === 0){
            //         // このタイミングで押してないのに走る謎

            //         this.$store.commit('setScreenId', 5)
            //     }
            //     if(this.selectedCharaCursor === 1){
            //         this.$store.commit('setScreenId', 6)
            //     }
            //     if(this.selectedCharaCursor === 2){
            //         //キャラ図鑑を表示する
            //         //this.$store.commit('setScreenId', 7)
            //     }
            //     if(this.selectedCharaCursor === 3){
            //         //おわかれ画面を表示する
            //         //this.$store.commit('setScreenId', 8)
            //     }
            // }
        // esc
            // if(e.keyCode === 27 && this.$store.state.screenId === 3){
            //     // this.$store.commit('setScreenId', 0)
            //     // removeEventListener('keyup',this.selectCommand2)
            //     // this.selectedCharaCursor = 0
            // }
        }
    }
}
</script>