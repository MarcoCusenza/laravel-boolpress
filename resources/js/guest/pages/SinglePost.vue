<template>
  <div>
    <h2></h2>
  </div>
</template>

<script>
export default {
  name: "SinglePost",
  data() {
    return {
      posts: {},
    };
  },
  created() {
    axios.get(`api/posts/${this.$route.params.slug}`).then((response) => {
      console.log(response.data);
    });
  },
};
</script>

<style>
</style>