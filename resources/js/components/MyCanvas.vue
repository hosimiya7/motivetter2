<template>
  <canvas width="750" height="150" class="canvas"></canvas>
</template>

<script>
export default {
    data() {
        return {
            screen_w: 750,
            screen_h: 150,
            chara_w: 150,
            chara_h: 75,
            d: 30,
            x: 0,
            y: 0,
            ctx: undefined,
            is_left: true
        }
    },
    methods: {
        // 初期化
        init() {
            this.x = (this.screen_w - this.chara_w) / 2
            this.y = this.screen_h - this.chara_h
            this.ctx = this.$el.getContext('2d')
        },

        draw() {
            //  キャラクターの描画
            this.ctx.clearRect(0, 0, this.screen_w, this.screen_h)

            // 向きの決定
            this.setCharaDirection()

            // キャラクターの位置決定
            if (this.is_left) {
                if (this.isTouchWall()) {
                    this.x += this.d
                } else {
                    this.x -= this.d
                }
            } else {
                if (this.isTouchWall()) {
                    this.x -= this.d
                } else {
                    this.x += this.d
                }
            }
        },

        // キャラクターが壁に当たるか判断
        isTouchWall() {
            if (this.is_left && this.x > 0) {
                return false
            }
            if (!this.is_left && this.x < this.screen_w - this.chara_w) {
                return false
            }
            return true
        },
        setCharaDirection(){
            this.is_left = Math.floor(Math.random() * 2) === 0
            let chara = new Image();

            // 画像のURLを指定
            if(this.is_left){
                chara.src = "/imgs/moti_" + this.$store.state.characters.character_template.id + "_left.png"
            }else{
                chara.src = "/imgs/moti_" + this.$store.state.characters.character_template.id + "_right.png"
            }

            chara.onload = () => {
                this.ctx.drawImage(chara, this.x, this.y, this.chara_w, this.chara_h)
            }

        }



    },
    //   htmlに接続されたら
    mounted() {
        // mounted 以降で canvas の DOM にアクセスできる
        // CreateJS などを使うときにも、ここで canvas と紐付ける
        // console.log(this.$el)
        this.init()
        setInterval(this.draw, 2000)
    }
}
</script>
