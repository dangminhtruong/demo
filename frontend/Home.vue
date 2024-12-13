<template>
  <div class="recruitment-table">
    <h1>Recruitment table</h1>
    <div class="columns">
      <div v-for="status in statuses" :key="status.key" :class="['column', status.class]">
        <h2>{{ status.title }} ({{ candidates[status.key] ? candidates[status.key].length : 0 }})</h2>
        <div
          class="candidate-card"
          v-for="candidate in candidates[status.key]"
          :key="candidate.id"
        >
          <h3 @click="$router.push(`/profile/${candidate.id}`)">{{ candidate.fullname }}</h3>
          <p>{{ candidate.position || 'CEO' }}</p>
          <p>{{ candidate.year_of_experience }} years of experience</p>
          <p v-if="candidate.reason" class="rejected-reason">{{ candidate.reason }}</p>
        </div>
      </div>
    </div>
    <button @click="$router.push('/apply')" class="new-candidate-button">New candidate</button>
  </div>
</template>

<script>
import { mapState } from "vuex"

export default {
  name: "RecruitmentTable",
  mounted() {
    this.$store.dispatch("auth/getListCandidates", this.$route.params.id)
    console.log(this.candidates);
  },
  computed: {
    ...mapState("auth", [
      "candidates",
      "loading",
    ]),
  },
  data() {
    return {
      statuses: [
        { key: "initial_review", title: "Initial review", class: "initial-review" },
        { key: "first_contact", title: "First contact", class: "first-contact" },
        { key: "technical_maintenance", title: "Technical maintenance", class: "technical-maintenance" },
        { key: "technical_test", title: "Technical test", class: "technical-test" },
        { key: "specific_maintenance", title: "Specific maintenance", class: "specific-maintenance" },
        { key: "rejected", title: "Rejected", class: "rejected" },
      ],
    };
  },
  methods: {

  },
};
</script>

<style scoped>
.recruitment-table {
  font-family: Arial, sans-serif;
  padding: 20px;
}

.columns {
  display: flex;
  gap: 20px;
}

.column {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.initial-review {
  background-color: #e8f4ff;
}

.first-contact {
  background-color: #fff9e8;
}

.technical-maintenance {
  background-color: #f4e8ff;
}

.technical-test {
  background-color: #e8fff4;
}

.specific-maintenance {
  background-color: #fff4e8;
}

.rejected {
  background-color: #ffe8e8;
}

.candidate-card {
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
}

.rejected-reason {
  color: red;
  font-weight: bold;
}

.new-candidate-button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.new-candidate-button:hover {
  background-color: #0056b3;
}
</style>
