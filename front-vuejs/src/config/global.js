import Vue from 'vue'

export const baseApiUrl = 'http://localhost/api'

export const userKey = '_saude_paciente'

export function showError(e) {
    console.log(e)
    if (e && e.response && e.response.data) {
        Vue.toasted.global.defaultError({ msg: e.response.data.message })
    } else if (typeof e === 'string') {
        Vue.toasted.global.defaultError({ msg: e })
    } else {
        Vue.toasted.global.defaultError()
    }
}

export function showSuccess(e) {
    if (e && e.response && e.response.data) {
        Vue.toasted.global.defaultSuccess({ msg: e.response.data.message })
    } else if (typeof e === 'string') {
        Vue.toasted.global.defaultSuccess({ msg: e })
    } else {
        Vue.toasted.global.defaultSuccess()
    }
}

export default { baseApiUrl, showError, showSuccess, userKey }