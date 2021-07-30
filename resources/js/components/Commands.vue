<template>
  <div class="commands">
      <div class="command" v-bind:class="{active: this.$store.state.selectedCursor === 1}">目標達成</div>
      <div class="command" v-bind:class="{active: this.$store.state.selectedCursor === 2}">達成入力</div>
      <div class="command" v-bind:class="{active: this.$store.state.selectedCursor === 3}">キャラクター管理</div>
      <div class="command" v-bind:class="{active: this.$store.state.selectedCursor === 4}">ミニゲーム</div>
  </div>
</template>

<script>
export default {
    created: function() {
        addEventListener('keyup', this.selectCommand)
    },
    methods: {
        selectCommand(e) {
            //下
                if(e.keyCode === 40){
                    this.$store.commit('increment')
                    console.log(this.$store.state.selectedCursor)
                }
                // 上
                if(e.keyCode === 38){
                    this.$store.commit('decrement')
                    console.log(this.$store.state.selectedCursor)
                }
                // スペース　決定
                if(e.keyCode === 32){
                    if(this.$store.state.selectedCursor === 1){
                        this.$store.commit('setSelectedCommand', 1)
                    }
                    if(this.$store.state.selectedCursor === 2){
                        this.$store.commit('setSelectedCommand', 2)
                    }
                    if(this.$store.state.selectedCursor === 3){
                        this.$store.commit('setSelectedCommand', 3)
                    }
                    if(this.$store.state.selectedCursor === 4){
                        this.$store.commit('setSelectedCommand', 4)
                    }
                }
                // バック　戻る
                if(e.keyCode === 8){
                    this.$store.commit('setSelectedCommand', 0)
                }
        }

    }
}
</script>