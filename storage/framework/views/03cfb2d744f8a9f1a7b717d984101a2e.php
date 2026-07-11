
<?php $__env->startSection('title', 'Platillos'); ?>
<?php $__env->startSection('topbar-icon', 'egg-fried'); ?>
<?php $__env->startSection('topbar-title', 'Gestión de Platillos'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <p
                style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
                Gestión</p>
            <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Platillos y Bebidas</h1>
        </div>
        <a href="<?php echo e(route('admin.platos.create')); ?>" class="btn-admin btn-admin-gold">
            <i class="bi bi-plus-circle"></i> Nuevo Platillo
        </a>
    </div>

    <div class="content-card">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Sede</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Insignia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $platos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div style="font-weight:700;font-size:0.82rem;"><?php echo e($plato->nombre); ?></div>
                                <div
                                    style="font-size:0.7rem;color:var(--color-muted);max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    <?php echo e($plato->descripcion); ?>

                                </div>
                            </td>
                            <td><?php echo e($plato->sede->nombre); ?></td>
                            <td><?php echo e($plato->categoria->nombre); ?></td>
                            <td style="font-weight:700;color:var(--color-gold);">$<?php echo e(number_format($plato->precio, 2)); ?></td>
                            <td>
                                <span class="badge <?php echo e($plato->disponible ? 'badge-green' : 'badge-red'); ?>">
                                    <?php echo e($plato->disponible ? 'Disponible' : 'No disponible'); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($plato->es_insignia): ?>
                                    <span class="badge badge-gold"><i class="bi bi-award-fill"></i> Insignia</span>
                                <?php endif; ?>
                                <?php if($plato->es_temporada): ?>
                                    <span class="badge" style="background:rgba(48,93,66,0.1);color:#305D42;">
                                        <i class="bi bi-leaf"></i> Temporada
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <a href="<?php echo e(route('admin.platos.edit', $plato)); ?>"
                                        class="btn-admin btn-admin-outline btn-admin-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.platos.destroy', $plato)); ?>"
                                        onsubmit="return confirm('¿Eliminar este platillo?')">
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
                            <td colspan="7" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-inbox"
                                    style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                                No hay platillos registrados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($platos->hasPages()): ?>
            <div style="padding:1.25rem 1.5rem;border-top:1px solid var(--color-line);">
                <?php echo e($platos->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/admin/platos/index.blade.php ENDPATH**/ ?>