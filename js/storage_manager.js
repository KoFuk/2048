'use strict';

function StorageManager() {
    this.bestScoreKey = "bestScore";
    this.gameStateKey = "gameState";

    this.storage = {
        cache: {},

        updateCachedState: function (data) {
            return this.cache = JSON.parse(data)
        },

        setItem: function (id, val) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/internal/storage');
            const data = new FormData();
            data.append('key', id);
            data.append('value', val);
            xhr.send(data);
            return this.cache[id] = String(val);
        },

        getItem: function (id) {
            return this.cache.hasOwnProperty(id) ? this.cache[id] : undefined;
        },

        removeItem: function (id) {
            return delete this.cache[id];
        },

        clear: function () {
            return this.cache = {};
        }
    };
}

// Override cached state with given json data
StorageManager.prototype.updateCachedState = function (data) {
    return this.storage.updateCachedState(data);
};

// Best score getters/setters
StorageManager.prototype.getBestScore = function () {
    return this.storage.getItem(this.bestScoreKey) || 0;
};

StorageManager.prototype.setBestScore = function (score) {
    this.storage.setItem(this.bestScoreKey, score);
};

// Game state getters/setters and clearing
StorageManager.prototype.getGameState = function () {
    var stateJSON = this.storage.getItem(this.gameStateKey);
    return stateJSON ? JSON.parse(stateJSON) : null;
};

StorageManager.prototype.setGameState = function (gameState) {
    this.storage.setItem(this.gameStateKey, JSON.stringify(gameState));
};

StorageManager.prototype.clearGameState = function () {
    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', '/internal/storage');
    xhr.send();
    this.storage.removeItem(this.gameStateKey);
};
