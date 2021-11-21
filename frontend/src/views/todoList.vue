<template>
  <div>
    <menu-table />
    <todo-app />
  </div>
</template>

<script>
import TodoApp from "../components/TodoList/TodoApp.vue";
import MenuTable from "../components/menu.vue";
export default {
  components: {
    TodoApp,
    MenuTable,
  },
};
</script>
