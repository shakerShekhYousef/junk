<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});
// Home > Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});
// Home > create_user
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Create User', route('users.create'));
});
// Home > Users > Edit
Breadcrumbs::for('users.edit', function ($trail, $id) {
    $trail->parent('users.index');
    $trail->push('Edit User', route('users.edit', $id));
});
// Home > Users > Show
Breadcrumbs::for('users.show', function ($trail, $id) {
    $trail->parent('users.index');
    $trail->push('Show User', route('users.show', $id));
});
// Home > Users
Breadcrumbs::for('calendar', function ($trail) {
    $trail->parent('home');
    $trail->push('Calendar', route('calendar'));
});
// Home > Classes
Breadcrumbs::for('classes.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Classes', route('classes.index'));
});
// Home > Classes > Create
Breadcrumbs::for('classes.create', function ($trail) {
    $trail->parent('classes.index');
    $trail->push('Create Class', route('classes.create'));
});
// Home > Classes > Edit
Breadcrumbs::for('classes.edit', function ($trail, $id) {
    $trail->parent('classes.index');
    $trail->push('Edit Class', route('classes.edit', $id));
});
// Home > Classes > Show
Breadcrumbs::for('classes.show', function ($trail, $id) {
    $trail->parent('classes.index');
    $trail->push('Show Class', route('classes.show', $id));
});
// Home > Sessions
Breadcrumbs::for('sessions.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Sessions', route('sessions.index'));
});
// Home > Sessions > generate QR code
Breadcrumbs::for('sessions.generatesessiondailyqrcodeview', function ($trail) {
    $trail->parent('sessions.index');
    $trail->push('Generate Qr Code', route('web_generate_session_daily_qrcode_view'));
});
// Home > Sessions > attend session
Breadcrumbs::for('sessions.attendsession', function ($trail) {
    $trail->parent('sessions.index');
    $trail->push('Attend Session', route('web_attend_session'));
});
// Home > Sessions > create
Breadcrumbs::for('sessions.create', function ($trail) {
    $trail->parent('sessions.index');
    $trail->push('Create Session', route('sessions.create'));
});
// Home > Sessions > edit
Breadcrumbs::for('sessions.edit', function ($trail, $id) {
    $trail->parent('sessions.index');
    $trail->push('Edit Session', route('sessions.edit', $id));
});
// Home > Sessions > show
Breadcrumbs::for('sessions.show', function ($trail, $id) {
    $trail->parent('sessions.index');
    $trail->push('Show Session', route('sessions.show', $id));
});
// Home > Packages
Breadcrumbs::for('packages.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Packages', route('packages.index'));
});
// Home > Sessions > edit
Breadcrumbs::for('packages.create', function ($trail) {
    $trail->parent('packages.index');
    $trail->push('Create package', route('packages.create'));
});
// Home > Sessions > edit
Breadcrumbs::for('packages.edit', function ($trail, $id) {
    $trail->parent('packages.index');
    $trail->push('Edit package', route('packages.edit', $id));
});
// Home > Sessions > show
Breadcrumbs::for('packages.show', function ($trail, $id) {
    $trail->parent('packages.index');
    $trail->push('Show Package', route('packages.show', $id));
});
//Home > Payment
Breadcrumbs::for('payment', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Payment settings', route('payment', $id));
});
//Home > Reports
Breadcrumbs::for('jreports.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Reports', route('jreports.index'));
});
//Home > show report
Breadcrumbs::for('jreports.show', function ($trail, $id) {
    $trail->parent('jreports.index');
    $trail->push('Show Report', route('jreports.show', $id));
});
//Home > show purchase
Breadcrumbs::for('web_view_expiration_of_purchase', function ($trail) {
    $trail->parent('home');
    $trail->push('Show Purchase', route('web_view_expiration_of_purchase'));
});

//Home > musics
Breadcrumbs::for('musics.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Musics', route('musics.index'));
});

//Home > create music
Breadcrumbs::for('musics.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Create new music', route('musics.create'));
});

//Home > musics > show
Breadcrumbs::for('musics.show', function ($trail,$id) {
    $trail->parent('musics.index');
    $trail->push('Show music', route('musics.show',$id));
});

//Home > musics > edit
Breadcrumbs::for('musics.edit', function ($trail,$id) {
    $trail->parent('musics.index');
    $trail->push('edit music', route('musics.edit',$id));
});

//Home > orders
Breadcrumbs::for('web_get_orders_info', function ($trail) {
    $trail->parent('home');
    $trail->push('orders', route('web_get_orders_info'));
});

//Home > orders
Breadcrumbs::for('web_get_order_info_by_id', function ($trail,$id) {
    $trail->parent('web_get_orders_info');
    $trail->push('show', route('web_get_order_info_by_id',$id));
});

//Home > coaches
Breadcrumbs::for('web_index_coaches', function ($trail) {
    $trail->parent('home');
    $trail->push('coaches', route('web_index_coaches'));
});

//Home > create coache
Breadcrumbs::for('web_create_coach', function ($trail) {
    $trail->parent('web_index_coaches');
    $trail->push('create', route('web_create_coach'));
});

//Home > show coache
Breadcrumbs::for('web_show_coach', function ($trail, $id) {
    $trail->parent('web_index_coaches');
    $trail->push('show', route('web_show_coach', $id));
});

//Home > edit coache
Breadcrumbs::for('web_edit_coach', function ($trail, $id) {
    $trail->parent('web_index_coaches');
    $trail->push('edit', route('web_edit_coach', $id));
});
