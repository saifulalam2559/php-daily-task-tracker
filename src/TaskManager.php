<?php
class TaskManager {
    private $file;
    private $tasks;

    public function __construct($file) {
        $this->file = $file;
        if (!file_exists($file)) {
            file_put_contents($file, json_encode([]));
        }
        $this->tasks = json_decode(file_get_contents($file), true);
    }

    public function addTask($task) {
        $this->tasks[] = $task;
        $this->save();
    }

    public function removeTask($id) {
        unset($this->tasks[$id]);
        $this->tasks = array_values($this->tasks);
        $this->save();
    }

    public function getTasks() {
        return $this->tasks;
    }

    private function save() {
        file_put_contents($this->file, json_encode($this->tasks, JSON_PRETTY_PRINT));
    }
}
