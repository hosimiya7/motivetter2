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
                console.log(this.selectedCharaCursor)
            }
        // 上
            if(e.keyCode === 38 && this.selectedCharaCursor > 0){
                this.selectedCharaCursor--
                console.log(this.selectedCharaCursor)
            }
        }
    }
}
</script>