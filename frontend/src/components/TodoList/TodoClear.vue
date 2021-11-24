<template>
  <div>
    <div id="save-all">
      <span>Save</span>
    </div>
    <div id="clear-all" @click="clearAll">
      <span>Delete</span>
    </div>
  </div>
</template>

<script>
import Constant from "../../store/modules/constant";

export default {
  data() {
    return {
      todo: JSON.stringify(this.$store.state.todoList),
    };
  },
  name: "todo-clear",
  methods: {
    clearAll() {
      this.$store.commit(Constant.DELETE_ALL);
    },
  },
};
</script>

<style scoped>
#save-all {
  width: 40%;
  margin: 0 auto 0.5rem auto;
  height: 2.5rem;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03);
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.1rem;
  color: #483d8b;
  font-weight: 700;
}
#clear-all {
  width: 40%;
  margin: 0 auto 0.5rem auto;
  height: 2.5rem;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 5px 10px 10px rgba(0, 0, 0, 0.03);
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.1rem;
  color: #de4343;
  font-weight: 700;
}
</style>
