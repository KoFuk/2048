'use strict';

// Wait till the browser is ready to render the game (avoids glitches)
window.requestAnimationFrame(function () {
    new GameManager(4, new KeyboardInputManager(),
        new HTMLActuator(), new StorageManager());
});
