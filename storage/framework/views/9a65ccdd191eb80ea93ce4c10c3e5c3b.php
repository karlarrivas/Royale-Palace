
<?php $__env->startSection('title', 'Mi Cuenta — The Royale Palace'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .cuenta-hero {
            padding: 80px 0 60px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            position: relative;
            overflow: hidden;
        }

        .cuenta-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-gold), var(--color-green));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.3);
            flex-shrink: 0;
        }

        .reservacion-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 1.5rem 2rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .reservacion-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 2px 0 0 2px;
        }

        .reservacion-card.confirmada::before {
            background: var(--color-green);
        }

        .reservacion-card.pendiente::before {
            background: var(--color-gold);
        }

        .reservacion-card.cancelada::before {
            background: #E53935;
        }

        .reservacion-card.completada::before {
            background: #9E9E9E;
        }

        .reservacion-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
        }

        .estado-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .badge-confirmada {
            background: rgba(48, 93, 66, 0.1);
            color: var(--color-green);
        }

        .badge-pendiente {
            background: rgba(200, 162, 77, 0.1);
            color: var(--color-gold);
        }

        .badge-cancelada {
            background: rgba(229, 57, 53, 0.1);
            color: #E53935;
        }

        .badge-completada {
            background: rgba(0, 0, 0, 0.05);
            color: var(--color-muted);
        }

        .codigo-reserva {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--color-muted);
            font-family: monospace;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--color-bg-soft);
            border: 1px dashed var(--color-line);
            border-radius: 12px;
        }

        .alert-trp {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #E8F5E9;
            color: #2E7D32;
            border-left: 4px solid var(--color-green);
        }

        .alert-error {
            background: #FDECEA;
            color: #C62828;
            border-left: 4px solid #E53935;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

        <section class="cuenta-hero">
            <div class="container">
                <div class="d-flex align-items-center gap-4 flex-wrap">
                    <div class="avatar-circle">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                    <div>
                        <p class="section-label" style="margin-bottom:0.5rem;">Mi Cuenta</p>
                        <h1 class="section-title" style="margin-bottom:0.5rem;">
                            <?php echo e(strtoupper(Auth::user()->name)); ?>

                        </h1>
                        <p style="color:var(--color-muted);font-size:0.85rem;margin:0;">
                            <i class="bi bi-envelope me-1"></i><?php echo e(Auth::user()->email); ?>

                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section style="padding: 60px 0 100px; background: var(--color-bg-soft);">
            <div class="container">

                <?php if(session('success')): ?>
                    <div class="alert-trp alert-success">
                        <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert-trp alert-error">
                        <i class="bi bi-exclamation-circle-fill"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    
                    <div class="col-12">
                        <div class="row g-3">
                            <?php
    $total = $reservaciones->count();
    $proxTotal = $proximas->count();
    $canceladas = $reservaciones->where('estado', 'cancelada')->count();
                            ?>
                            <?php $__currentLoopData = [
        ['Total', $total, 'bi-calendar3', var_export($total > 0, true)],
        ['Próximas', $proxTotal, 'bi-calendar-check', 'true'],
        ['Historial', $reservaciones->where('estado', 'completada')->count(), 'bi-clock-history', 'false'],
        ['Canceladas', $canceladas, 'bi-x-circle', 'false'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $num, $icon, $gold]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                                <div cla    ss
                                =                               "col-6 col-md-3">

                                                                                        <div style="background:var(--color-bg);border:1px solid var(--color-line);
                                                                    border-radius:12px;padding:1.5rem;text-align:center;">
                                                            <i class="bi <?php echo e($icon); ?>" style="font-size:1.5rem;color:var(--color-gold);display:block;margin-bottom:0.75rem;"></i>
                                                            <p style="font-size:2rem;font-weight:800;color:var(--color-dark);margin:0;line-height:1;"><?php echo e($num); ?></p>
                                                            <p style="font-size:0.6rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--color-muted);margin-top:0.4rem;"><?php echo e($label); ?></p>
                                                    </div>
                                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </di
                           v>
                    </div>

                    
                <div class="col-12">
                    <div style="background:var(--color-bg);border:1px solid var(--color-line);border-radius:12px;padding:2rem;">
                            <div style="display:flex;align-items:center;justify-content:space-between;
                                        margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--color-line);">
                                <h2 style="font-size:0.75rem;font-weight:700;letter-spacing:3px;
                                           text-transform:uppercase;color:var(--color-dark);margin:0;
                                            display:flex;align-items:center;gap:8px;">
                                     <i class="bi bi-calendar-check" style="color:var(--color-gold);"></i>
                                    Reservaciones Próximas
                                </h2>
                                <a href="<?php echo e(route('reservaciones.create')); ?>"
                               class="btn-gold d-inline-flex align-items-center gap-2"
                                   style="font-size:0.6rem;padding:8px 18px;">
                                    <i class="bi bi-plus-circle"></i> Nueva
                                </a>
                            </div>

                            <?php $__empty_1 = true; $__currentLoopData = $proximas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <div class="reservacion-card <?php echo e($res->estado); ?>">
                                                                <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                                                                    <div style="flex:1;">
                                                                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                                                            <span class="estado-badge badge-<?php echo e($res->estado); ?>">
                                                                                <i class="bi bi-circle-fill" style="font-size:0.4rem;"></i>
                                                                                <?php echo e(ucfirst($res->estado)); ?>

                                                                            </span
                                                                                   >

                                                                                                                    <span class="codigo-reserva"><?php echo e($res->codigo); ?></span>

                                                                                                                </div>
                                                                        <div class="row g-2">
                                                                            <div c
                                                                                   lass="col-sm-6 col-md-3">

                                                                                                                        <p style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Sede</p>
                                                                                <p style="font-size:0.9rem;font-weight:700;color:var(--color-dark);margin:0;"><?php echo e($res->sede->nombre); ?></p>
                                                                            </div>
                                                                            <div class="col-sm-6 col-md-3">
                                                                                <p style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Fecha</p>
                                                                                <p
                                                                                    style="font-size:0.9rem;font-weight:700;color:var(--color-dark);margin:0;">

                                                                                                                                <?php echo e($res->fecha->format('d/m/Y')); ?>

                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-6 col-md-3">
                                                                                <p style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Hora · Mesa</p>
                                                                                <p
                                                                                    style="font-size:0.9rem;font-weight:700;color:var(--color-dark);margin:0;">

                                                                                                                                <?php echo e($res->hora); ?> · <?php echo e($res->mesa->numero); ?>

                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-6 col-md-3">
                                                                                <p style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Personas</p>
                                                                                <p style="font-size:0.9rem;font-weight:700;color:var(--color-dark);margin:0;">
                                                                                    <?php echo e($res->num_personas); ?>

                                                                                </p>
                                                                          </div>
                                                                        </div>
                                                                    </div>

                                                                    
                                <a href="<?php echo e(route('reservaciones.comprobante', $res)); ?>"
                                   target="_blank"
                                   style="display:inline-flex;align-items:center;gap:5px;
                                          padding:7px 16px;background:rgba(200,162,77,0.1);
                                          border:1px solid rgba(200,162,77,0.3);border-radius:6px;
                                          font-family:var(--font-main);font-size:0.6rem;
                                          font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
                                          color:var(--color-gold);text-decoration:none;transition:all 0.2s;">
                                    <i class="bi bi-printer"></i> Comprobante
                                </a>
                                                                <?php if(in_array($res->estado, ['pendiente', 'confirmada']) && $res->fecha >= today()): ?>
                                                                    <form method="POST" action="<?php echo e(route('reservaciones.cancelar', $res)); ?>"
                                                                          onsubmit="return confirm('¿Cancelar esta reservación?')">
                                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                                        <button type="submit"
                                                                                style="display:inline-flex;align-items:center;gap:5px;
                                                                                           padding:7px 16px;background:transparent;
                                                                                           border:1px solid #FFCDD2;border-radius:6px;
                                                                                           font-family:var(--font-main);font-size:0.6rem;
                                                                                           font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
                                                                                           color:#E53935;cursor:pointer;transition:all 0.2s;">
                                                                                <i class="bi bi-x-circle"></i> Cancelar
                                                                            </button>
                                                                        </form>
                                                                <?php endif; ?>

                                                                                           </div>
                                                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="empty-state">
                                     <i class="bi bi-calendar-x" style="font-size:3rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                                    <p style="color:var(--color-muted);font-size:0.9rem;margin-bottom:1.5rem;">
                                        No tienes reservaciones próximas.
                                    </p>
                                    <a href="<?php echo e(route('reservaciones.create')); ?>"
                                       class="btn-gold d-inline-flex align-items-center gap-2">
                                        <i class="bi bi-calendar-plus"></i> Hacer mi Primera Reservación
                                </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                
                <?php if($reservaciones->where('fecha', '<', today())->count() || $reservaciones->whereIn('estado', ['cancelada', 'completada'])->count()): ?>
                    <div class="col-12">
                            <div style="background:var(--color-bg);border:1px solid var(--color-line);border-radius:12px;padding:2rem;">
                                <h2 style="font-size:0.75rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;
                                           color:var(--color-dark);margin-bottom:1.5rem;padding-bottom:1rem;
                                           border-bottom:1px solid var(--color-line);
                                           display:flex;align-items:center;gap:8px;">
                                    <i class="bi bi-clock-history" style="color:var(--color-gold);"></i> Historial
                                </h2>
                                <?php $__currentLoopData = $reservaciones->whereIn('estado', ['cancelada', 'completada'])->merge(
            $reservaciones->where('fecha', '<', today())->whereIn('estado', ['pendiente', 'confirmada'])
        )->sortByDesc('fecha')->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="reservacion-card <?php echo e($res->estado); ?>" style="opacity:0.7;">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <span class="estado-badge badge-<?php echo e($res->estado); ?>"><?php echo e(ucfirst($res->estado)); ?></span>
                                            <span class="codigo-reserva"><?php echo e($res->codigo); ?></span>
                                            <span style="font-size:0.8rem;color:var(--color-muted);">
                                                <i class="bi bi-geo-alt me-1"></i><?php echo e($res->sede->nombre); ?>

                                            </span>
                                            <span style="font-size:0.8rem;color:var(--color-muted);">
                                                <i class="bi bi-calendar3 me-1"></i><?php echo e($res->fecha->format('d/m/Y')); ?>

                                                · <?php echo e($res->hora); ?>

                                            </span>
                                            <span style="font-size:0.8rem;color:var(--color-muted);">
                                                <i class="bi bi-table me-1"></i><?php echo e($res->mesa->numero); ?>

                                        </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/cuenta/index.blade.php ENDPATH**/ ?>