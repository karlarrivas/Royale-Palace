
<?php $__env->startSection('title', 'Reservaciones'); ?>
<?php $__env->startSection('topbar-icon', 'calendar-check'); ?>
<?php $__env->startSection('topbar-title', 'Gestión de Reservaciones'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <p
                style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
                Gestión</p>
            <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Reservaciones</h1>
        </div>
        <a href="<?php echo e(route('admin.reservaciones.reporte')); ?>" class="btn-admin btn-admin-gold" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Generar Reporte PDF
        </a>
    </div>

    
    <div class="content-card" style="margin-bottom:1.5rem;">
        <div class="content-card-body">
            <form method="GET" action="<?php echo e(route('admin.reservaciones.index')); ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-calendar3"></i> Fecha</label>
                        <input type="date" name="fecha" class="form-control-admin" value="<?php echo e(request('fecha')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-circle-fill"></i> Estado</label>
                        <select name="estado" class="form-control-admin">
                            <option value="">Todos</option>
                            <option value="pendiente" <?php echo e(request('estado') == 'pendiente' ? 'selected' : ''); ?>>Pendiente
                            </option>
                            <option value="confirmada" <?php echo e(request('estado') == 'confirmada' ? 'selected' : ''); ?>>Confirmada
                            </option>
                            <option value="cancelada" <?php echo e(request('estado') == 'cancelada' ? 'selected' : ''); ?>>Cancelada
                            </option>
                            <option value="completada" <?php echo e(request('estado') == 'completada' ? 'selected' : ''); ?>>Completada
                            </option>
                        </select>
                    </div>
                    <?php if (\Illuminate\Support\Facades\Blade::check('hasrole', 'super_admin')): ?>
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-geo-alt"></i> Sede</label>
                        <select name="sede_id" class="form-control-admin">
                            <option value="">Todas las sedes</option>
                            <?php $__currentLoopData = \App\Models\Sede::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>" <?php echo e(request('sede_id') == $s->id ? 'selected' : ''); ?>>
                                    <?php echo e($s->nombre); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-2">
                        <button type="submit" class="btn-admin btn-admin-gold" style="width:100%;">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo e(route('admin.reservaciones.index')); ?>" class="btn-admin btn-admin-outline"
                            style="width:100%;">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-list-ul"></i> Lista de Reservaciones
                <span style="font-size:0.65rem;font-weight:600;color:var(--color-muted);margin-left:0.5rem;">
                    (<?php echo e($reservaciones->total()); ?> total)
                </span>
            </h2>
        </div>

        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Sede</th>
                        <th>Fecha · Hora</th>
                        <th>Mesa · Personas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reservaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span style="font-family:monospace;font-size:0.72rem;font-weight:700;color:var(--color-gold);">
                                                <?php echo e($res->codigo); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;"><?php echo e($res->user->name); ?></div>
                                            <div style="font-size:0.7rem;color:var(--color-muted);"><?php echo e($res->user->email); ?></div>
                                        </td>
                                        <td style="font-size:0.82rem;"><?php echo e($res->sede->nombre); ?></td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;"><?php echo e($res->fecha->format('d/m/Y')); ?></div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);"><?php echo e($res->hora); ?></div>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;"><?php echo e($res->mesa->numero); ?></div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);"><?php echo e($res->num_personas); ?> personas</div>
                                        </td>
                                        <td>
                                            <span class="badge <?php echo e(match ($res->estado) {
                            'confirmada' => 'badge-green',
                            'pendiente' => 'badge-gold',
                            'cancelada' => 'badge-red',
                            default => 'badge-gray'
                        }); ?>"><?php echo e(ucfirst($res->estado)); ?></span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                                <?php if($res->estado === 'pendiente'): ?>
                                                    <form method="POST" action="<?php echo e(route('admin.reservaciones.estado', $res)); ?>">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                        <input type="hidden" name="estado" value="confirmada">
                                                        <button class="btn-admin btn-admin-sm"
                                                            style="background:rgba(48,93,66,0.1);color:#305D42;border:1px solid rgba(48,93,66,0.2);border-radius:6px;">
                                                            <i class="bi bi-check-circle"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                <?php if(in_array($res->estado, ['pendiente', 'confirmada'])): ?>
                                                    <form method="POST" action="<?php echo e(route('admin.reservaciones.estado', $res)); ?>"
                                                        onsubmit="return confirm('¿Cancelar esta reservación?')">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                        <input type="hidden" name="estado" value="cancelada">
                                                        <button class="btn-admin btn-admin-danger btn-admin-sm">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                <?php if($res->estado === 'confirmada'): ?>
                                                    <form method="POST" action="<?php echo e(route('admin.reservaciones.estado', $res)); ?>">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                        <input type="hidden" name="estado" value="completada">
                                                        <button class="btn-admin btn-admin-sm"
                                                            style="background:rgba(33,150,243,0.1);color:#1565C0;border:1px solid rgba(33,150,243,0.2);border-radius:6px;">
                                                            <i class="bi bi-check2-all"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-calendar-x"
                                    style="font-size:2.5rem;display:block;margin-bottom:0.75rem;opacity:0.3;"></i>
                                No hay reservaciones con los filtros seleccionados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($reservaciones->hasPages()): ?>
            <div style="padding:1.25rem 1.5rem;border-top:1px solid var(--color-line);">
                <?php echo e($reservaciones->withQueryString()->links()); ?>

            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/admin/reservaciones/index.blade.php ENDPATH**/ ?>