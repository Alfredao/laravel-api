<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Trigger para crédito
        DB::unprepared('
            CREATE TRIGGER atualiza_saldo_credito
            AFTER INSERT ON extratos
            FOR EACH ROW
            BEGIN
                IF NEW.tipo = "credito" THEN
                    UPDATE users
                    SET saldo = saldo + NEW.valor
                    WHERE id = NEW.user_id;
                END IF;
            END
        ');

        // Trigger para débito
        DB::unprepared('
            CREATE TRIGGER atualiza_saldo_debito
            AFTER INSERT ON extratos
            FOR EACH ROW
            BEGIN
                IF NEW.tipo = "debito" THEN
                    UPDATE users
                    SET saldo = saldo - NEW.valor
                    WHERE id = NEW.user_id;
                END IF;
            END
        ');
    }

    public function down()
    {
        // Remove os triggers caso seja feito rollback
        DB::unprepared('DROP TRIGGER IF EXISTS atualiza_saldo_credito');
        DB::unprepared('DROP TRIGGER IF EXISTS atualiza_saldo_debito');
    }
};
