<?php $__env->startSection('content'); ?>
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">✅ Task List</h1>
    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="flex gap-3 mb-8">
        <?php echo csrf_field(); ?>
        <input 
            type="text" 
            name="name" 
            class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg text-base focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors" 
            placeholder="Add a new task..." 
            required
        >
        <button 
            type="submit" 
            class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Add Task
        </button>
    </form>
    
    <?php if($tasks->count() > 0): ?>
        <ul class="space-y-3">
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200 hover:translate-x-1 <?php echo e($task->done ? 'opacity-60' : ''); ?>">
                    <form action="<?php echo e(route('tasks.update', $task)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input 
                            type="checkbox" 
                            name="done" 
                            value="1"
                            class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer"
                            <?php echo e($task->done ? 'checked' : ''); ?>

                            onchange="this.form.submit()"
                        >
                    </form>
                    <span class="flex-1 text-base text-gray-800 <?php echo e($task->done ? 'line-through text-gray-500' : ''); ?>">
                        <?php echo e($task->name); ?>

                    </span>
                    <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" 
                            onclick="return confirm('Are you sure you want to delete this task?')"
                        >
                            Delete
                        </button>
                    </form>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <div class="text-center py-12 text-gray-500">
            <div class="text-6xl mb-4">📝</div>
            <p class="text-lg">No tasks yet. Add one above!</p>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin123/untitled/resources/views/tasks/index.blade.php ENDPATH**/ ?>