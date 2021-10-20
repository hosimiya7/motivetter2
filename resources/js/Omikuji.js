export default class Omikuji {

    cur_num
    selected_num
    interval
    omikuji

    constructor (){
        this.cur_num = 0
        this.selected_num = 0
        this.interval = 0
        this.omikuji = [
            "大吉",
            "吉",
            "中吉",
            "小吉",
            "末吉",
            "凶",
            "大凶"
        ]
    }

    // おみくじを順で表示する
    start = () => {
        this.interval = setInterval(this.runOmikuji, 100)
    }

    setText = (value) => {
        document.getElementById('selected').textContent = value
    }

    //　おみくじを配列から選ぶ
    runOmikuji = () =>{
        this.setText(this.omikuji[this.cur_num])
        this.cur_num++
        if(this.cur_num === this.omikuji.length - 1){
            this.cur_num = 0
        }
    }
    // おみくじをとめる
    stopOmikuji = () => {
        clearInterval(this.interval)
        this.selected_num = this.cur_num
        this.setText(this.omikuji[this.selected_num])
    }
    // おみくじを始める
    startOmikuji = () => {
        this.selected_num = 0
        clearInterval(this.interval)
        this.start()
    }
}