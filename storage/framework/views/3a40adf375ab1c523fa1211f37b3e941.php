
<?php $__env->startSection('title', 'Mesas'); ?>
<?php $__env->startSection('topbar-icon', 'table'); ?>
<?php $__env->startSection('topbar-title', 'Gestión de Mesas'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <p
                style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
                Gestión</p>
            <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Mesas</h1>
        </div>
        <a href="<?php echo e(route('admin.mesas.create')); ?>" class="btn-admin btn-admin-gold">
            <i class="bi bi-plus-circle"></i> Nueva Mesa
        </a>
    </div>

    <div class="content-card">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Sede</th>
                        <th>Capacidad</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $mesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mesa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td style="font-weight:700;"><?php echo e($mesa->numero); ?></td>
                                        <td><?php echo e($mesa->sede->nombre); ?></td>
                                        <td><?php echo e($mesa->capacidad); ?> personas</td>
                                        <td>
                                            <span class="badge badge-gray">
                                                <i class="bi bi-<?php echo e(match ($mesa->ubicacion) {
                            'interior' => 'house-door',
                            'exterior' => 'tree',
                            'terraza' => 'sun',
                            'privada' => 'shield-lock',
                            default => 'table'
                        }); ?>"></i>
                                                <?php echo e(ucfirst($mesa->ubicacion)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo e($mesa->activa ? 'badge-green' : 'badge-red'); ?>">
                                                <?php echo e($mesa->activa ? 'Activa' : 'Inactiva'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <a href="<?php echo e(route('admin.mesas.edit', $mesa)); ?>"
                                                    class="btn-admin btn-admin-outline btn-admin-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="<?php echo e(route('admin.mesas.destroy', $mesa)); ?>"
                                                    onsubmit="return confirm('¿Eliminar esta mesa?')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button class="btn-admin btn-admin-danger btn-admin-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-table"
                                    style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                                No hay mesas registradas
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/admin/mesas/index.blade.php ENDPATH**/ ?>