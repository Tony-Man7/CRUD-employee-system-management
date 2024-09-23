<template>
    <div class="container mx-auto">
      <h2 class="text-center text-2xl font-bold">Kanban Board</h2>
      <div class="flex space-x-4" id="kanban-board">
        <div class="w-1/3">
          <div class="bg-white shadow-md rounded-lg">
            <div class="bg-blue-600 text-white p-4 rounded-t-lg">
              <div class="flex justify-between">
                <div>To Do</div>
                <div>
                  <button
                    @click="showTaskModal('todo')"
                    class="bg-teal-500 text-white px-4 py-2 rounded-full"
                  >
                    +
                  </button>
                </div>
              </div>
            </div>
            <div class="p-4 connectedSortable" ref="todo">
              <div
                v-for="item in todoTasks"
                :key="item.id"
                class="bg-white shadow-md rounded-lg mb-2 kanban-item"
              >
                <div class="p-4">
                  <div class="flex justify-between">
                    <div class="text-sm font-medium text-gray-900">{{ item.name }}</div>
                    <div class="space-x-2">
                      <button
                        @click="editTask(item)"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-edit"></i>
                      </button>
                      <button
                        @click="deleteTask(item.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-x"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-1/3">
          <div class="bg-white shadow-md rounded-lg">
            <div class="bg-yellow-500 text-white p-4 rounded-t-lg">
              <div class="flex justify-between">
                <div>In Progress</div>
                <div>
                  <button
                    @click="showTaskModal('in_progress')"
                    class="bg-teal-500 text-white px-4 py-2 rounded-full"
                  >
                    +
                  </button>
                </div>
              </div>
            </div>
            <div class="p-4 connectedSortable" ref="inProgress">
              <div
                v-for="item in inProgressTasks"
                :key="item.id"
                class="bg-white shadow-md rounded-lg mb-2 kanban-item"
              >
                <div class="p-4">
                  <div class="flex justify-between">
                    <div class="text-sm font-medium text-gray-900">{{ item.name }}</div>
                    <div class="space-x-2">
                      <button
                        @click="editTask(item)"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-edit"></i>
                      </button>
                      <button
                        @click="deleteTask(item.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-x"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-1/3">
          <div class="bg-white shadow-md rounded-lg">
            <div class="bg-green-500 text-white p-4 rounded-t-lg">
              <div class="flex justify-between">
                <div>Done</div>
                <div>
                  <button
                    @click="showTaskModal('done')"
                    class="bg-teal-500 text-white px-4 py-2 rounded-full"
                  >
                    +
                  </button>
                </div>
              </div>
            </div>
            <div class="p-4 connectedSortable" ref="done">
              <div
                v-for="item in doneTasks"
                :key="item.id"
                class="bg-white shadow-md rounded-lg mb-2 kanban-item"
              >
                <div class="p-4">
                  <div class="flex justify-between">
                    <div class="text-sm font-medium text-gray-900">{{ item.name }}</div>
                    <div class="space-x-2">
                      <button
                        @click="editTask(item)"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-edit"></i>
                      </button>
                      <button
                        @click="deleteTask(item.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded-full text-sm"
                      >
                        <i class="bx bx-comment-x"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Modal for Adding/Editing Task -->
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h5 class="text-xl font-bold mb-4">{{ modalTitle }}</h5>
          <input
            v-model="taskName"
            type="text"
            class="w-full px-4 py-2 border rounded mb-4"
            placeholder="Task Name"
          />
          <div class="flex justify-end space-x-2">
            <button @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-full">Close</button>
            <button @click="saveTask" class="bg-blue-500 text-white px-4 py-2 rounded-full">Save Task</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showModal: false,
        taskName: "",
        currentSection: "",
        addOrUpdate: "add",
        selectedTask: null,
        todoTasks: [],
        inProgressTasks: [],
        doneTasks: [],
      };
    },
    computed: {
      modalTitle() {
        return this.addOrUpdate === "add" ? "Add Task" : "Edit Task";
      },
    },
    methods: {
      showTaskModal(section) {
        this.currentSection = section;
        this.addOrUpdate = "add";
        this.taskName = "";
        this.showModal = true;
      },
      editTask(item) {
        this.currentSection = item.status;
        this.addOrUpdate = "update";
        this.selectedTask = item;
        this.taskName = item.name;
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      },
      saveTask() {
        if (this.addOrUpdate === "add") {
          const newTask = { id: Date.now(), name: this.taskName, status: this.currentSection };
          if (this.currentSection === "todo") {
            this.todoTasks.push(newTask);
          } else if (this.currentSection === "in_progress") {
            this.inProgressTasks.push(newTask);
          } else {
            this.doneTasks.push(newTask);
          }
        } else {
          this.selectedTask.name = this.taskName;
        }
        this.closeModal();
      },
      deleteTask(id) {
        this.todoTasks = this.todoTasks.filter((task) => task.id !== id);
        this.inProgressTasks = this.inProgressTasks.filter((task) => task.id !== id);
        this.doneTasks = this.doneTasks.filter((task) => task.id !== id);
      },
    },
    mounted() {
      // Fetch initial tasks data (simulated here)
      this.todoTasks = [
        { id: 1, name: "Sample Task 1", status: "todo" },
        { id: 2, name: "Sample Task 2", status: "todo" },
      ];
      this.inProgressTasks = [
        { id: 3, name: "Sample Task 3", status: "in_progress" },
      ];
      this.doneTasks = [
        { id: 4, name: "Sample Task 4", status: "done" },
      ];
    },
  };
  </script>
  
  <style scoped>
  .kanban-item {
    cursor: move;
  }
  </style>
  