{{-- WhatsApp invitation template config (per event). $event may be null on create. --}}
@php
    $event = $event ?? null;
    $tplName = old('wa_template_name', $event->wa_template_name ?? '');
    $tplLang = old('wa_template_language', $event->wa_template_language ?? 'ar');
    $tplImg  = old('wa_template_header_image', $event->wa_template_header_image ?? '');
    $tplParamsArr = old('wa_template_params', isset($event) && is_array($event->wa_template_params) ? $event->wa_template_params : []);
    $tplParamsText = is_array($tplParamsArr) ? implode("\n", $tplParamsArr) : $tplParamsArr;
@endphp

<div class="settings-section-title contact-field-full">
    <h6>WhatsApp Invitation Template (optional)</h6>
    <p>لو حطيت اسم template معتمد، الدعوات هتتبعت بيه (بيوصل في أي وقت). لو سيبته فاضي، هتتبعت رسالة نصية عادية.</p>
</div>

<div class="contact-field">
    <label for="wa_template_name">Template Name</label>
    <input type="text" name="wa_template_name" id="wa_template_name"
           class="form-control contact-input @error('wa_template_name') is-invalid @enderror"
           value="{{ $tplName }}" placeholder="مثال: waled_text">
    @error('wa_template_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>

<div class="contact-field">
    <label for="wa_template_language">Template Language</label>
    <input type="text" name="wa_template_language" id="wa_template_language"
           class="form-control contact-input" value="{{ $tplLang }}" placeholder="ar">
</div>

<div class="contact-field contact-field-full">
    <label for="wa_template_header_image">Header Image URL (optional)</label>
    <input type="text" name="wa_template_header_image" id="wa_template_header_image"
           class="form-control contact-input" value="{{ $tplImg }}"
           placeholder="https://.../image.png  (سيبه فاضي لو التمبليت مفيهوش صورة)">
</div>

<div class="contact-field contact-field-full">
    <label for="wa_template_params">Template Variables — متغير في كل سطر (بالترتيب @{{1}}, @{{2}}...)</label>
    <textarea name="wa_template_params" id="wa_template_params" rows="6"
              class="form-control contact-input settings-textarea"
              placeholder="{event_name}&#10;{contact_name}&#10;{event_date}&#10;{event_location}&#10;{invite_link}">{{ $tplParamsText }}</textarea>
    <small class="text-muted d-block mt-2">
        المتغيرات المتاحة:
        <code>{contact_name}</code>
        <code>{event_name}</code>
        <code>{event_date}</code>
        <code>{event_time}</code>
        <code>{event_location}</code>
        <code>{guests_count}</code>
        <code>{invite_link}</code>
        — اكتب كل قيمة لـ <code>@{{n}}</code> في سطر منفصل بنفس ترتيب التمبليت.
    </small>
</div>
