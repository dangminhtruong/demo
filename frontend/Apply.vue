<template>
  <div class="conatiner">
    <div class="left"></div>
    <div class="right" :loading="loading">
      <h3 class="welcome">Japan Awaits</h3>

      <div class="form-item">
        <p class="label">Fullname</p>
        <el-input v-model="fullname" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.fullname"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <div class="form-item">
        <p class="label">Email</p>
        <el-input v-model="email" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.email"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <div class="form-item">
        <p class="label">Phone number</p>
        <el-input v-model="phone" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.phone"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <div class="form-item">
        <p class="label">Github Profile</p>
        <el-input v-model="githubProfile" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.github_profile"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <div class="form-item">
        <p class="label">Linkedin Profile</p>
        <el-input v-model="linkedinProfile" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.linkedin_profile"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <div class="form-item">
        <p class="label">Year of Experience</p>
        <el-input v-model="yearOfExperience" clearable> </el-input>
        <p
          class="error"
          v-for="(item, index) in validate.year_of_experience"
          :key="`email-${index}`"
        >
          {{ item }}
        </p>
      </div>

      <p class="forgot"></p>
      <el-button type="primary" class="custom-btn" @click="apply"
        ><b>Apply</b></el-button
      >
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState("auth", ["validate", "loading"]),
  },
  data() {
    return {
      fullname: null,
      email: null,
      phone: null,
      githubProfile: null,
      linkedinProfile: null,
      yearOfExperience: null,
    };
  },

  mounted() {
    this.$store.commit("auth/UPDATE_VALIDATE_ERRORS", []);
  },

  methods: {
    apply() {
      this.$store.dispatch("auth/apply", {
        fullname: this.fullname,
        email: this.email,
        phone: this.phone,
        github_profile: this.githubProfile,
        linkedin_profile: this.linkedinProfile,
        year_of_experience: this.yearOfExperience,
        status: 'first_contact'
      });
    },
  },
};
</script>

<style scoped>
.error {
  font-size: 13px;
    margin-top: 10px;
    color: red;
}
.conatiner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
}
.welcome {
  font-size: 20px;
  font-weight: 500;
}
.left {
  background-image: url("../assets/matsumoto-one-day-tour.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.forgot {
  color: rgb(100 213 29);
  color: #5e6d82;
  font-size: 13px;
  font-weight: 500;
  margin: 0px;
  padding: 14px 0px;
  cursor: pointer;
}
.right {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
  padding: 15% 10% 20% 10%;
}
.label {
  font-size: 13px;
  padding: 9px 0px;
  color: rgb(0 0 0);
}
.custom-btn {
  margin-left: unset !important;
  margin-bottom: 10px;
}
.signup {
  color: #5e6d82;
  text-decoration: none;
  cursor: pointer;
}
.not-member {
  position: fixed;
  top: 10px;
  font-size: 15px;
  right: 10px;
}
</style>