.SILENT:

.PHONY: all
all:
	:

test:
	make -s all
	bash local/test.sh

.PHONY: status
status:
	git status .

.PHONY: diff
diff:
	git diff .

.PHONY: showadd
showadd:
	git add --dry-run .

.PHONY: add
add:
	git add --verbose .

.PHONY: commit
commit:
	git commit --message "modifications" .; :

.PHONY: push
push:
	git push

.PHONY: pull
pull:
	git pull && make -s
