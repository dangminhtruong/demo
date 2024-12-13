import app from '@/main'
import { 
 apply, getListCandidates, getCandidateDetails
} from '@/api/auth.js'

import { message } from '@/utils/message.js'

const state = {
  loading: true,
  candidates: [],
  candidate: {},
  validate: {},
  nextStep: '/'
}

// getters
const getters = {}

// actions
const actions = {

  async apply({commit, state}, req) {
    commit('UPDATE_LOADING', true)
    try {
      const {data} = await apply(req)
      app.$cookies.set('token', `Bearer ${data.token}`)
      commit('UPDATE_VALIDATE_ERRORS', {})
      app.$router.push(state.nextStep)
    } catch ({response}) {
      commit('UPDATE_VALIDATE_ERRORS', response.data.errors)
    } finally {
      commit('UPDATE_LOADING', false)
    }
  },

  async getListCandidates({commit}) {
    commit('UPDATE_LOADING', true)
    try {
      const {data} = await getListCandidates()
      commit('UPDATE_CANDIDATES', data)
    } catch ({response}) {
      message(response.data.message, 'error')
    } finally {
      commit('UPDATE_LOADING', false)
    }
  },

  async getCandidateDetails({commit}, id) {
    commit('UPDATE_LOADING', true)
    try {
      const {data} = await getCandidateDetails(id)
      commit('UPDATE_CANDIDATE', data)
    } catch ({response}) {
      message(response.data.message, 'error')
    } finally {
      commit('UPDATE_LOADING', false)
    }
  },

}

// mutations

const mutations = {
  UPDATE_VALIDATE_ERRORS(state, errors){
    state.validate = errors
  },

  UPDATE_LOADING(state, status){
    state.loading = status
  },
  UPDATE_CANDIDATES(state, candidates) {
    console.log(candidates);
    state.candidates = candidates
  },

  UPDATE_CANDIDATE(state, {candidate}) {
    console.log(candidate);
    state.candidate = candidate
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}