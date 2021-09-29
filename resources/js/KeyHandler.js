
export default class KeyHandler {

    constructor(keyCode){
        this.keyCode = keyCode
    }

    isKeyDown() {
        return this.keyCode === 40
    }
    isKeyUp() {
        return this.keyCode === 38
    }
    isKeySpace() {
        return this.keyCode === 32
    }
    isKeyEsc() {
        return this.keyCode === 27
    }

}