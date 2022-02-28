<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 py-4">
        <div class="card text-center">
          <div class="card-body">
            <ul v-for="(category, i) in categories" :key="i">
              <a href="#">
                <li class="category-box">
                  <h3>{{ category.name }}</h3>
                  <router-link
                    class="button-link"
                    :to="{
                      name: 'single-category',
                      params: { slug: category.slug },
                    }"
                  >
                    Visualizza
                  </router-link>
                </li>
              </a>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Categories",
  data() {
    return {
      categories: [],
    };
  },
  created() {
    axios.get("/api/categories").then((response) => {
      this.categories = response.data;
    });
  },
};
</script>

<style lang="scss" scoped>
.card {
  border: none;
  border-radius: 10px;

  .card-body {
    display: grid;
    grid-template: 1fr / repeat(2, 1fr);
    gap: 30px 40px;
    padding: 60px;
    border-radius: 10px;
    background-color: rgb(30, 168, 150);

    ul {
      list-style: none;

      .category-box {
        background-color: #524848;
        border-radius: 10px;
        color: #ffffff;
        padding: 30px;
        position: relative;

        .button-link {
          position: absolute;
          bottom: 20px;
          right: 30px;
          background-color: #ff715b;
          color: #fff;
        }

        .button-link:hover {
          background-color: #000000;
        }
      }
    }
  }
}
</style>