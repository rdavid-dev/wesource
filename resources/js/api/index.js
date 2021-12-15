import axios from 'axios';

class Api {
    constructor() {
        this.endpoint = 'api/'
    }

    post(path, data, params) {
        return this._send({
            method: 'POST',
            path,
            data,
            params
        });
    }

    put(path, data, params) {
        return this._send({
            method: 'PUT',
            path,
            data,
            params
        });
    }

    get(path, data, params) {
        return this._send({
            method: 'GET',
            path,
            data,
            params
        });
    }

    delete(path, data, params) {
        return this._send({
            method: 'DELETE',
            path,
            data,
            params
        });
    }

    async _send({
        method = 'GET',
        path = '',
        data = {},
        params = {}
    }) {
        const headers = {};

        try {
            const response = await axios({
                method,
                url: `${this.endpoint}${path}`,
                params,
                data,
                headers,
            });

            if (response && response.data) {
                return response.data;
            }

            return null;
        } catch (error) {
            return {
                message: error.response.data.error
            };
        }
    }
}

export default new Api()
