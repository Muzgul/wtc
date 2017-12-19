make -C libft/ fclean && make -C libft/
clang -g -Wall -Werror -Wextra -I libft/includes -o filler.o -c filler.c
# clang -g -Wall -Werror -Wextra -I libft/includes -o main.o -c main.c
# clang -o test_gnl main.o filler.o -I libft/includes -L libft/ -lft
clang -o test_gnl filler.o -I libft/includes -L libft/ -lft
