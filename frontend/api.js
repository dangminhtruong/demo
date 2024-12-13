import axios from "@/utils/axios"
export const apply = data => axios.post('/candidate/apply', data)
export const getListCandidates = () => axios.get(`/candidate/list`)
export const getCandidateDetails = (id) => axios.get(`/candidate/${id}`)