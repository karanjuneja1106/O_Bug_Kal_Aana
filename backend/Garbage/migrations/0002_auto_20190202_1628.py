# Generated by Django 2.1.5 on 2019-02-02 16:28

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Garbage', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='garbage',
            name='garbage_img',
            field=models.ImageField(blank=True, null=True, upload_to='garbage/'),
        ),
    ]