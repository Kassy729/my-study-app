<template>
  <div id="todo-app">
    <h1>MY-TODO-</h1>
    <todo-input />
    <todo-list />
    <todo-clear />
  </div>
</template>

<script>
import TodoClear from "./TodoClear.vue";
import TodoInput from "./TodoInput.vue";
import TodoList from "./TodoList.vue";
export default {
  components: { TodoInput, TodoList, TodoClear },
};
</script>

<style scoped>
#todo-app {
  margin: 0 0.5rem;
  position: relative;
}
h1 {
  color: #484848;
  text-align: center;
  padding-top: 2.5rem;
}
</style>
