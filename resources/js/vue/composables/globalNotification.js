// composables/useGlobalError.js
import { reactive } from 'vue';

const states = reactive([]);

const state = {
    visible: false,
    message: '',
    title: 'Error',
    type: 'error',
    resolve: null,
    timeout: null
};

export function useGlobalNotification() {
    function show(text, type = 'error', timeout = null) {

        let state = {
            visible: false,
            message: '',
            title: 'Error',
            type: 'error',
            resolve: null,
            timeout: null
        };

        state.type = type;

        state.message = text || '';

        switch (type) {
            case 'info':
                state.title = 'Info';
                break;
            case 'success':
                state.title = 'Success';
                break;
            case 'error':
                state.title = 'Error';
                break;
            default:
                state.title = 'Error';
                break;
        }

        state.visible = true;
        state.timeout = timeout;

        let stateWait = states.find(s => s.type == 'wait');
        let returnIndex;

        if (stateWait && type == 'wait') {
            stateWait.timeout = timeout ?? 10000;

            returnIndex = states.findIndex(s => s.type == 'wait');
        } else {

            states.push(state);

            if (timeout) {
                setTimeout(() => {
                    close(states.length - 1);
                }, timeout);
            }

            if (!timeout && type == 'wait') {
                setTimeout(() => {
                    close(states.length - 1);
                }, 10000);
            }

            new Promise((resolve) => {
                state.resolve = resolve;
            });

            returnIndex = states.length - 1;
        }

        return returnIndex;
    }

    function close(stateIndex) {
        let state = states[stateIndex];

        if (!state) {
            return;
        }

        state.visible = false;

        if (state.resolve) {
            state.resolve();
            state.resolve = null;
            state.timeout = null;

            states.splice(stateIndex, 1);
        }
    }

    return {
        states: states,
        showNotify: show,
        closeNotify: close
    };
}