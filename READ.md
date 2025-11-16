1️⃣ Keep separate archive tables
You actually copy the record from agendas → archived_agendas and concerns → archived_concerns.

Pros: Original table stays “clean,” archived data is separate.

Cons: Extra tables, every time you archive, you need to copy all columns, relationships, and possibly attachments/comments. It’s more maintenance-heavy.

2️⃣ Use soft deletes + archived_at column (what I recommended)
You keep everything in the main table. Archiving is just setting a flag (archived_at) and optionally using deleted_at for soft delete.

Pros:

No duplicate tables, simpler migration and relationships.

Queries can easily filter active vs archived with whereNull('archived_at') or use Laravel scopes.

All relationships still work without extra joins or syncing between tables.

Cons: Data grows in the main table, though indexing can handle that.

