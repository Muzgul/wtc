make -C libft/ fclean && make -C libft/
clang -g -Wall -Werror -Wextra -I libft/includes -o lem_in.o -c lem_in.c
clang -g -Wall -Werror -Wextra -I libft/includes -o main.o -c main.c
clang -o test_gnl main.o lem_in.o -I libft/includes -L libft/ -lft
