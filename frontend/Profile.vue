<template>
  <div class="candidate-detail">
    <div class="header">
      <div class="name">
        <h1>{{ candidate.fullname }}</h1>
        <p>{{ candidate.position | 'CEO' }}</p>
      </div>
      <div class="actions">
        <button class="reject" @click="rejectCandidate">Reject</button>
        <button class="notify" @click="notifyCandidate">Notify</button>
      </div>
    </div>

    <div class="section">
      <h3>Contact information</h3>
      <p>Email: <a :href="`mailto:${candidate.email}`">{{ candidate.email }}</a></p>
      <p>Phone: {{ candidate.phone }}</p>
    </div>

    <div class="section">
      <h3>Profiles</h3>
      <p><a :href="candidate.github_profile" target="_blank">GitHub</a></p>
      <p><a :href="candidate.linkedin_profile" target="_blank">LinkedIn</a></p>
    </div>

    <div class="section">
      <h3>Professional details</h3>
      <p>Experience: {{ candidate.year_of_experience }}</p>
      <p>Technical stack: Laravel</p>
    </div>

    <div class="section">
      <h3>Status</h3>
      <p>Current stage: {{ candidate.status }}</p>
    </div>

    <div class="section">
      <h3>Significant project</h3>
      <p>Startup</p>
    </div>

    <div class="section">
      <h3>Complex technical situation</h3>
      <p>N/A</p>
    </div>

    <div class="section">
      <h3>Management experience</h3>
      <p>10</p>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex"
export default {
  name: "CandidateDetail",
  computed: {
    ...mapState("auth", [
      "candidate",
      "loading",
    ]),
  },
  mounted() {
    this.$store.dispatch("auth/getCandidateDetails", this.$route.params.id)
    console.log(this.candidate);
  },
  methods: {
    rejectCandidate() {
      alert("Candidate rejected");
    },
    notifyCandidate() {
      alert("Candidate notified");
    },
  },
};
</script>

<style scoped>
.candidate-detail {
  font-family: Arial, sans-serif;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
  background-color: #fff;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.name h1 {
  margin: 0;
  font-size: 24px;
}

.name p {
  margin: 0;
  color: #666;
}

.actions button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

.actions .reject {
  background-color: #ff4d4d;
  color: white;
  margin-right: 10px;
}

.actions .notify {
  background-color: #007bff;
  color: white;
}

.actions button:hover {
  opacity: 0.8;
}

.section {
  margin-bottom: 20px;
}

.section h3 {
  margin-bottom: 10px;
  font-size: 16px;
  color: #333;
}

.section p {
  margin: 0;
  color: #555;
}

.section a {
  color: #007bff;
  text-decoration: none;
}

.section a:hover {
  text-decoration: underline;
}
</style>
