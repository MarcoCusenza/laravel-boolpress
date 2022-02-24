<template>
  <div class="post-list">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 py-4">
          <div class="card text-center">
            <div class="card-body">
              <div class="textbox">
                <h1>Chi Siamo</h1>
                <p>Siamo noi.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "About",
};
</script>

<style lang="scss" scoped>
.card {
  border: none;
  border-radius: 10px;
  .card-body {
    padding: 60px;
    border-radius: 10px;
    background-color: rgb(30, 168, 150);
    .textbox{
      background-color: #524848;
      border-radius: 10px;
      padding: 30px;
      color: #ffffff;
    }
  }
}
</style>