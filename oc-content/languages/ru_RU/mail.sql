INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (1, 'ru_RU', '{WEB_TITLE} - У кого-то есть вопрос о вашем объявлении', '<p>Привет {CONTACT_NAME}!</p><p>{USER_NAME} ({USER_EMAIL}, {USER_PHONE}) написал сообщение по поводу Вашего объявления <a href="{ITEM_URL}">{ITEM_TITLE}</a>:</p><p>{COMMENT}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (2, 'ru_RU', 'Подтверждение регистрации на сайте {WEB_TITLE}', '<p>Привет {USER_NAME},</p><p>Просьба подтвердить Вашу регистрацию, нажав на следующую ссылку: {VALIDATION_LINK}</p><p>Спасибо!</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (3, 'ru_RU', '{WEB_TITLE} - Успешная регистрация!', '<p>Здравствуйте {USER_NAME},</p><p>Вы зарегистрировались на сайте {WEB_LINK}.</p><p>Спасибо!</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (4, 'ru_RU', 'Посмотри, что я обнаружил на {WEB_TITLE}', '<p>Привет {FRIEND_NAME},</p><p>Ваш друг {USER_NAME} хочет поделиться с Вами информацией <a href="{ITEM_URL}">{ITEM_TITLE}</a>.</p><p>Сообщение:</p><p>{COMMENT}</p><p>С уважением,</p><p>{WEB_TITLE}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (5, 'ru_RU', '{WEB_TITLE} - Новые объявления за последний час', '<p>Привет {USER_NAME},</p><p>Новые объявления опубликованные за последний час. Взгляните на них:</p><p>{ADS}</p><p>-------------</p><p>Чтобы отписаться от этой рассылки , перейдите по ссылке: {UNSUB_LINK}</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (6, 'ru_RU', '{WEB_TITLE} - Новые объявления за последний день', '<p>Привет {USER_NAME},</p><p>Новые объявления за прошедший день. Взгляните на них:</p><p>{ADS}</p><p>-------------</p><p>Чтобы отписаться от этой рассылки, перейдите по ссылке: {UNSUB_LINK}</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (7, 'ru_RU', '{WEB_TITLE} - Новые объявления за последнюю неделю', '<p>Привет {USER_NAME},</p><p>Новые объявления опубликованные на прошлой неделе. Взгляните на них:</p><p>{ADS}</p><p>-------------</p><p>Чтобы отписаться от этой рассылки, перейдите по ссылке: {UNSUB_LINK}</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (8, 'ru_RU', '{WEB_TITLE} - Новое объявление', '<p>Привет {USER_NAME},</p><p>Опубликовано новое объявление!</p><p>{ADS}</p><p>-------------</p><p>Для того чтобы отписаться от этой рассылки, перейдите по ссылке: {UNSUB_LINK}</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (9, 'ru_RU', '{WEB_TITLE} - Новый комментарий', '<p>Кто-то оставил комментарий к Вашему объявлениию <a href="{ITEM_URL}">{ITEM_TITLE}</a>.</p><p>Автор: {COMMENT_AUTHOR}<br />Email автора: {COMMENT_EMAIL}<br />Заголовок: {COMMENT_TITLE}<br />Комментарий: {COMMENT_TEXT}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (10, 'ru_RU', '{WEB_TITLE} - Возможности редактирования для объявления {ITEM_TITLE}', '<p>Здравствуйте {USER_NAME},</p><p>Вы не зарегистрированы на сайте {WEB_LINK}, но Вы можете отредактировать или удалить своё объявление <a href="{ITEM_URL}">{ITEM_TITLE}</a> в течение короткого периода времени.</p><p>Редактировать можно по этой ссылке: {EDIT_LINK}</p><p>Удалить объявление можно по этой ссылке: {DELETE_LINK}</p><p>Если Вы зарегистрируетесь, то у Вас будет доступ ко всем функциям сайта.</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (11, 'ru_RU', '{WEB_TITLE} - Подтверждение объявления', '<p>Здравствуйте {USER_NAME},</p><p>Вы получли это письмо потому что опубликовали объявление на сайте {WEB_LINK}. Подтвердите публикацию кликом по следующей ссылке: {VALIDATION_LINK}. Если Вы не размещали объявление, проигнорируйте это письмо.</p><p>Деталои:</p><p>Имя: {USER_NAME}<br />e-mail: {USER_EMAIL}</p><p>{ITEM_DESCRIPTION}</p><p>Url: {ITEM_URL}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (12, 'ru_RU', '{WEB_TITLE} - Опубликовано новое объявление', '<p>Дорогой{WEB_TITLE} admin,</p><p>Вы получили это письмо потому что было опубликовано объявление на сайте {WEB_LINK}.</p><p>Детали:</p><p>Имя: {USER_NAME}<br />email: {USER_EMAIL}</p><p>{ITEM_DESCRIPTION}</p><p>Url: {ITEM_URL}</p><p>YВы можете отредактировать объявление по ссылке: {EDIT_LINK}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (13, 'ru_RU', '{WEB_TITLE} - Восстановления пароля', '<p>Здравствуйте {USER_NAME},</p><p>Вы получили это письмо, так как сделал запрос на восстановление пароля. Перейдите по этой ссылке: {PASSWORD_LINK}</p><p>Ссылка станет не активной через 24 часа.</p><p>Если вы не делали запрос, проигнорируйте письмо. Запрос был отправлен с IP {IP_ADDRESS}, дата {DATE_TIME}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (14, 'ru_RU', '{WEB_TITLE} - Запрос на смену адреса почты', '<p>Здравствуйте {USER_NAME}</p><p>Вы получили это письмо, так как сделал запрос на смену e-mail. Перейдите по этой ссылке: {VALIDATION_LINK}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (15, 'ru_RU', '{WEB_TITLE} - Пожалуйста, подтвердите подписку', '<p>Привет {USER_NAME},</p><p> подтвердите регистрацию, нажав на следующую ссылку: {VALIDATION_LINK}</p><p>Спасибо!</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (16, 'ru_RU', '{WEB_TITLE} - Ваш комментарий одобрен', '<p>Привет {COMMENT_AUTHOR},</p><p>Ваш комментарий на <a href="{ITEM_URL}">{ITEM_TITLE}</a> успешно утвержден.</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (17, 'ru_RU', '{WEB_TITLE} - Подтверждение объявления', '<p>Здравствуйте {USER_NAME},</p><p>Вы получили это письмо, так как опубликовали объявление на сайте {WEB_LINK}. Подтвердите публикацию по ссылке: {VALIDATION_LINK}. Если Вы не размещали объявление, проигнорируйте письмо.</p><p>Детали объявления:</p><p>Имя: {USER_NAME}<br />e-mail: {USER_EMAIL}</p><p>{ITEM_DESCRIPTION}</p><p>Url: {ITEM_URL}</p><p>Если Вы не зарегистрированы на {WEB_LINK}, Вы всё равно сможете отредактировать или удалить объявление:</p><p>Редактировать можно по этйо ссылке: {EDIT_LINK}</p><p>Удалить можно по этой ссылке: {DELETE_LINK}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (18, 'ru_RU', '{WEB_TITLE} - Регистрация нового пользователя', '<p>Dear {WEB_TITLE} admin,</p><p>Вы получили это письмо, так как новый пользователь зарегистрировался на сайте {WEB_LINK}.</p><p>Детали:</p><p>Имя: {USER_NAME}<br />E-mail: {USER_EMAIL}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (19, 'ru_RU', '{WEB_TITLE} - У кого то есть вопрос к Вам', '<p>Привет {CONTACT_NAME}!</p><p>{USER_NAME} ({USER_EMAIL}, {USER_PHONE}) оставил Вам сообщение:</p><p>{COMMENT}</p><p>С уважением,</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (20, 'ru_RU', '{WEB_TITLE} - Кто то оставил комментарий на Ваше объявление', '<p>Новый комментарий к Вашему объявлению: <a href="{ITEM_URL}">{ITEM_TITLE}</a>.</p><p>Автор: {COMMENT_AUTHOR}<br />Email автора: {COMMENT_EMAIL}<br />Заголовок: {COMMENT_TITLE}<br />Комментарий: {COMMENT_TEXT}</p><p>{WEB_LINK}</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (21, 'ru_RU', '{WEB_TITLE} - Успешное создание учетной записи администратора!', '<p>Здравствуйте {ADMIN_NAME},</p><p>Администратор {WEB_LINK} создал для Вас личный кабинет,</p><ul><li>Имя пользователя: {USERNAME}</li><li>Пароль: {PASSWORD}</li></ul><p>Для управления вашим личным кабинетом перейдите по ссылке {WEB_ADMIN_LINK}.</p><p>Благодарим Вас!</p><p>С уважением,</p>');
INSERT INTO /*TABLE_PREFIX*/t_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (22, 'ru_RU', '{WEB_TITLE} - Ваше объявление скоро станет не актуальным', '<p>Привет {USER_NAME},</p><p> Ваше объявление <a href="{ITEM_URL}">{ITEM_TITLE}</a> - уже не актуально {WEB_LINK}.');