
<?php $__env->startSection('title', 'Editar Platillo'); ?>
<?php $__env->startSection('topbar-icon', 'egg-fried'); ?>
<?php $__env->startSection('topbar-title', 'Editar Platillo'); ?>

<?php $__env->startSection('content'); ?>

    <div class="mb-4">
        <a href="<?php echo e(route('admin.platos.index')); ?>" class="btn-admin btn-admin-outline btn-admin-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="content-card" style="max-width:750px;">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-pencil-square"></i> Editar: <?php echo e($plato->nombre); ?>

            </h2>
        </div>
        <div class="content-card-body">
            <form method="POST" action="<?php echo e(route('admin.platos.update', $plato)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-type"></i> Nombre del Platillo
                            </label>
                            <input type="text" name="nombre" class="form-control-admin"
                                value="<?php echo e(old('nombre', $plato->nombre)); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-currency-dollar"></i> Precio
                            </label>
                            <input type="number" name="precio" step="0.01" min="0" class="form-control-admin"
                                value="<?php echo e(old('precio', $plato->precio)); ?>" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-text-paragraph"></i> Descripción
                            </label>
                            <textarea name="descripcion" class="form-control-admin" rows="3"
                                required><?php echo e(old('descripcion', $plato->descripcion)); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-geo-alt"></i> Sede
                            </label>
                            <select name="sede_id" class="form-control-admin" required>
                                <?php $__currentLoopData = $sedes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sede): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sede->id); ?>" <?php echo e(old('sede_id', $plato->sede_id) == $sede->id ? 'selected' : ''); ?>>
                                        <?php echo e($sede->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-tag"></i> Categoría
                            </label>
                            <select name="categoria_id" class="form-control-admin" required>
                                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>" <?php echo e(old('categoria_id', $plato->categoria_id) == $cat->id ? 'selected' : ''); ?>>
                                        <?php echo e($cat->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-12">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-image"></i> Imagen del Platillo
                            </label>

                            
                            <?php if($plato->imagen): ?>
                                <div style="margin-bottom:1rem;">
                                    <img src="<?php echo e(asset('images/platos/' . $plato->imagen)); ?>" alt="<?php echo e($plato->nombre); ?>" style="width:120px;height:90px;object-fit:cover;
                                                border-radius:8px;border:1px solid var(--color-line);">
                                    <p style="font-size:0.65rem;color:var(--color-muted);margin-top:0.4rem;">
                                        <i class="bi bi-info-circle"></i> Imagen actual — sube una nueva para reemplazarla
                                    </p>
                                </div>
                            <?php else: ?>
                                <div style="margin-bottom:1rem;padding:1.5rem;background:var(--color-bg-soft);
                                            border:1px dashed var(--color-line);border-radius:8px;text-align:center;">
                                    <i class="bi bi-image"
                                        style="font-size:2rem;color:var(--color-line);display:block;margin-bottom:0.5rem;"></i>
                                    <p style="font-size:0.72rem;color:var(--color-muted);">Sin imagen actual</p>
                                </div>
                            <?php endif; ?>

                            <input type="file" name="imagen" class="form-control-admin"
                                accept="image/jpeg,image/png,image/webp" id="imagenInput" onchange="previewImage(this)">
                            <p style="font-size:0.65rem;color:var(--color-muted);margin-top:0.4rem;">
                                Formatos: JPG, PNG, WEBP · Máximo 2MB
                            </p>

                            
                            <div id="imagePreview" style="display:none;margin-top:1rem;">
                                <img id="previewImg" style="width:120px;height:90px;object-fit:cover;
                                            border-radius:8px;border:2px solid var(--color-gold);">
                                <p style="font-size:0.65rem;color:var(--color-gold);margin-top:0.4rem;">
                                    <i class="bi bi-check-circle"></i> Nueva imagen seleccionada
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-toggle-on"></i> Disponible
                            </label>
                            <select name="disponible" class="form-control-admin">
                                <option value="1" <?php echo e(old('disponible', $plato->disponible) ? 'selected' : ''); ?>>
                                    Sí — Disponible
                                </option>
                                <option value="0" <?php echo e(!old('disponible', $plato->disponible) ? 'selected' : ''); ?>>
                                    No — No disponible
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-award"></i> Platillo Insignia
                            </label>
                            <select name="es_insignia" class="form-control-admin">
                                <option value="0" <?php echo e(!old('es_insignia', $plato->es_insignia) ? 'selected' : ''); ?>>No
                                </option>
                                <option value="1" <?php echo e(old('es_insignia', $plato->es_insignia) ? 'selected' : ''); ?>>Sí
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin">
                                <i class="bi bi-leaf"></i> De Temporada
                            </label>
                            <select name="es_temporada" class="form-control-admin">
                                <option value="0" <?php echo e(!old('es_temporada', $plato->es_temporada) ? 'selected' : ''); ?>>No
                                </option>
                                <option value="1" <?php echo e(old('es_temporada', $plato->es_temporada) ? 'selected' : ''); ?>>Sí
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn-admin btn-admin-gold">
                            <i class="bi bi-check-circle"></i> Actualizar Platillo
                        </button>
                        <a href="<?php echo e(route('admin.platos.index')); ?>" class="btn-admin btn-admin-outline"
                            style="margin-left:0.5rem;">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\royale-palace\resources\views/admin/platos/edit.blade.php ENDPATH**/ ?>