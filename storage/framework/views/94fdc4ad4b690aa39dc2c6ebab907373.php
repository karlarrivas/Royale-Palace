

<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('topbar-icon', 'speedometer2'); ?>
<?php $__env->startSection('topbar-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <div style="margin-bottom:2rem;">
        <p
            style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
            Panel de Control
        </p>
        <h1 style="font-size:1.6rem;font-weight:800;color:var(--color-dark);letter-spacing:1px;">
            Bienvenido, <?php echo e(Auth::user()->name); ?>

        </h1>
    </div>

    
    <div class="widget-grid">
        <div class="widget-card">
            <div class="widget-icon"><i class="bi bi-calendar-check"></i></div>
            <div class="widget-value"><?php echo e($reservacionesHoy); ?></div>
            <div class="widget-label">Reservaciones Hoy</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(48,93,66,0.1);">
                <i class="bi bi-calendar-month" style="color:var(--color-green);"></i>
            </div>
            <div class="widget-value"><?php echo e($reservacionesMes); ?></div>
            <div class="widget-label">Este Mes</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(33,150,243,0.1);">
                <i class="bi bi-table" style="color:#1976D2;"></i>
            </div>
            <div class="widget-value"><?php echo e($mesasOcupadas); ?></div>
            <div class="widget-label">Mesas Activas</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(156,39,176,0.1);">
                <i class="bi bi-egg-fried" style="color:#7B1FA2;"></i>
            </div>
            <div class="widget-value"><?php echo e($platosDisponibles); ?></div>
            <div class="widget-label">Platos Disponibles</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(255,152,0,0.1);">
                <i class="bi bi-people" style="color:#E65100;"></i>
            </div>
            <div class="widget-value"><?php echo e($clientesRegistrados); ?></div>
            <div class="widget-label">Clientes</div>
        </div>
    </div>

    
    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-clock-history"></i> Últimas Reservaciones
            </h2>
            <a href="<?php echo e(route('admin.reservaciones.index')); ?>" class="btn-admin btn-admin-outline btn-admin-sm">
                Ver Todas <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Sede</th>
                        <th>Fecha · Hora</th>
                        <th>Mesa</th>
                        <th>Personas</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ultimasReservaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span style="font-family:monospace;font-size:0.75rem;font-weight:700;color:var(--color-gold);">
                                                <?php echo e($res->codigo); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;"><?php echo e($res->user->name); ?></div>
                                            <div style="font-size:0.7rem;color:var(--color-muted);"><?php echo e($res->user->email); ?></div>
                                        </td>
                                        <td><?php echo e($res->sede->nombre); ?></td>
                                        <td>
                                            <div style="font-weight:600;"><?php echo e($res->fecha->format('d/m/Y')); ?></div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);"><?php echo e($res->hora); ?></div>
                                        </td>
                                        <td><?php echo e($res->mesa->numero); ?></td>
                                        <td><?php echo e($res->num_personas); ?></td>
                                        <td>
                                            <span class="badge <?php echo e(match ($res->estado) {
                            'confirmada' => 'badge-green',
                            'pendiente' => 'badge-gold',
                            'cancelada' => 'badge-red',
                            default => 'badge-gray'
                        }); ?>">
                                                <?php echo e(ucfirst($res->estado)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php if($res->estado === 'pendiente'): ?>
                                                <form method="POST" action="<?php echo e(route('admin.reservaciones.estado', $res)); ?>"
                                                    style="display:inline">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" name="estado" value="confirmada">
                                                    <button class="btn-admin btn-admin-sm"
                                                        style="background:rgba(48,93,66,0.1);color:#305D42;border:1px solid rgba(48,93,66,0.2);border-radius:6px;">
                                                        <i class="bi bi-check-circle"></i> Confirmar
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-inbox"
                                    style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                                No hay reservaciones registradas
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>