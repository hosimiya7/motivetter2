<template>
    <div class="message-chara">

        <h3>▼ キャラクターステータス</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span>現在経験値: {{ characters.exp }}</span>
                <span>好感度: {{ characters.love}}</span>
            </div>
            <div class="chara-index-second">
                <span>必要経験値: 0</span>
                <span>成長度: {{ characters.growth }}</span>
            </div>
        </div>

    </div>
</template>

<script lang="ts">
    export default {
        created: function() {
            addEventListener('keyup', this.selectCommand)
        },
        data() {
            return{
                characters: [],
            }
        },
        mounted() {
            // ページ遷移挟まないと表示されない
            window.axios.get('/api/character/show')
            .then(response =>{
                this.characters = response['data'];
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        methods: {
        selectCommand(e) {
            if(e.keyCode === 27){
                this.$store.commit('setSelectedCommand', 3)
            }
        }
    }
    }
</script>